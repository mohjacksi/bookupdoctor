<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSpecialtyRequest;
use App\Http\Requests\UpdateSpecialtyRequest;
use App\Http\Resources\Admin\SpecialtyResource;
use App\Models\Specialty;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecialtiesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        //abort_if(Gate::denies('specialty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $specialties = Specialty::all();
        // $specialties = Specialty::withCount('specialtiesDoctors')->get();
        foreach($specialties as $i => $specialty){
            if ($specialty->icon != null)
                $specialty->image_url = $specialty->icon->url;
            // if($specialty->specialties_doctors_count == 0)
            //     $specialties[$i] = null;
        }
        // dd($specialties);

        return new SpecialtyResource($specialties);
    }

    public function store(StoreSpecialtyRequest $request)
    {
        $specialty = Specialty::create($request->all());

        if ($request->input('icon', false)) {
            $specialty->addMedia(storage_path('tmp/uploads/' . $request->input('icon')))->toMediaCollection('icon');
        }

        return (new SpecialtyResource($specialty))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Specialty $specialty)
    {
        abort_if(Gate::denies('specialty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SpecialtyResource($specialty);
    }

    public function update(UpdateSpecialtyRequest $request, Specialty $specialty)
    {
        $specialty->update($request->all());

        if ($request->input('icon', false)) {
            if (!$specialty->icon || $request->input('icon') !== $specialty->icon->file_name) {
                if ($specialty->icon) {
                    $specialty->icon->delete();
                }

                $specialty->addMedia(storage_path('tmp/uploads/' . $request->input('icon')))->toMediaCollection('icon');
            }
        } elseif ($specialty->icon) {
            $specialty->icon->delete();
        }

        return (new SpecialtyResource($specialty))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Specialty $specialty)
    {
        abort_if(Gate::denies('specialty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialty->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
