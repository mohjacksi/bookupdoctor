<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\Admin\DoctorResource;
use App\Models\Doctor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Day;
class DoctorsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        //abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //$doctors = Doctor::with(['specialties', 'days', 'city'])->get();

        $city_id = request()->city_id;
        $search = request()->search;
        $specialty_id = request()->specialty_id;

        $doctors = Doctor::select(['id','name','about','is_special','stars']);
        if(isset($city_id))
            $doctors = $doctors->where('city_id', $city_id);
        if(isset($search))
            $doctors = $doctors->where('name', "like", "%" . $search . "%");
        if(isset($specialty_id))
            $doctors = $doctors->whereHas('specialties', function ($query) use($specialty_id){
                return $query->where('specialty_id', $specialty_id);
            });
            //->with('specialties')->where('specialty_id', $specialty_id);
        $doctors = $doctors->paginate(10);
        foreach ($doctors as $doctor)
            if ($doctor->image != null)
                $doctor->image_url = $doctor->image->thumbnail;
        //$doctors = $doctors->makeHidden(['media','image']);
        return new DoctorResource($doctors);
    }

    public function store(StoreDoctorRequest $request)
    {
        $doctor = Doctor::create($request->all());
        $doctor->specialties()->sync($request->input('specialties', []));
        $doctor->days()->sync($request->input('days', []));

        if ($request->input('image', false)) {
            $doctor->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }
        return (new DoctorResource($doctor))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show($id)
    {
        //abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $doctor = Doctor::select('id','name','about','stars','location','latitude','longitude', 'notes')->find($id);
        $doctor->load('days');
        return new DoctorResource($doctor);
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->all());
        $doctor->specialties()->sync($request->input('specialties', []));
        $doctor->days()->sync($request->input('days', []));

        if ($request->input('image', false)) {
            if (!$doctor->image || $request->input('image') !== $doctor->image->file_name) {
                if ($doctor->image) {
                    $doctor->image->delete();
                }
                $doctor->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($doctor->image) {
            $doctor->image->delete();
        }

        return (new DoctorResource($doctor))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
