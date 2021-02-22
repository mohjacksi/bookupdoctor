<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDoctorRequest;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\City;
use App\Models\Day;
use App\Models\Doctor;
use App\Models\Specialty;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DoctorsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = Doctor::with(['specialties', 'days', 'city', 'media'])->get();

        $specialties = Specialty::get();

        $days = Day::get();

        $cities = City::get();

        return view('frontend.doctors.index', compact('doctors', 'specialties', 'days', 'cities'));
    }

    public function create()
    {
        abort_if(Gate::denies('doctor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialties = Specialty::all()->pluck('name', 'id');

        $days = Day::all()->pluck('name', 'id');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.doctors.create', compact('specialties', 'days', 'cities'));
    }

    public function store(StoreDoctorRequest $request)
    {
        $doctor = Doctor::create($request->all());
        $doctor->specialties()->sync($request->input('specialties', []));
        $doctor->days()->sync($request->input('days', []));

        if ($request->input('image', false)) {
            $doctor->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $doctor->id]);
        }

        return redirect()->route('frontend.doctors.index');
    }

    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialties = Specialty::all()->pluck('name', 'id');

        $days = Day::all()->pluck('name', 'id');

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctor->load('specialties', 'days', 'city');

        return view('frontend.doctors.edit', compact('specialties', 'days', 'cities', 'doctor'));
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

        return redirect()->route('frontend.doctors.index');
    }

    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->load('specialties', 'days', 'city', 'doctorPortfolios', 'doctorPayments');

        return view('frontend.doctors.show', compact('doctor'));
    }

    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->delete();

        return back();
    }

    public function massDestroy(MassDestroyDoctorRequest $request)
    {
        Doctor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('doctor_create') && Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Doctor();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
