<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Http\Resources\Admin\PharmacyResource;
use App\Models\Pharmacy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PharmaciesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        //abort_if(Gate::denies('pharmacy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $city_id = request()->city_id;
        $search = request()->search;

        $pharmacies = Pharmacy::select(['id','name','is_special','location']);
        if(isset($city_id))
            $pharmacies = $pharmacies->where('city_id', $city_id);

        if(isset($search))
        $pharmacies = $pharmacies
        ->where('name', "like", "%" . $search . "%");

        $pharmacies = $pharmacies->paginate(10);
        foreach ($pharmacies as $pharmacy)
            if ($pharmacy->logo != null)
                $pharmacy->image_url = $pharmacy->logo->url;

        return new PharmacyResource($pharmacies);
    }

    public function store(StorePharmacyRequest $request)
    {
        $pharmacy = Pharmacy::create($request->all());
        $pharmacy->days()->sync($request->input('days', []));

        if ($request->input('logo', false)) {
            $pharmacy->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
        }

        return (new PharmacyResource($pharmacy))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show($id)
    {
        // abort_if(Gate::denies('pharmacy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pharmacy = Pharmacy::select('id','name','location','latitude','longitude', 'notes','phone_number')->find($id);
        $pharmacy->load('days');
        return new PharmacyResource($pharmacy);
    }

    public function update(UpdatePharmacyRequest $request, Pharmacy $pharmacy)
    {
        $pharmacy->update($request->all());
        $pharmacy->days()->sync($request->input('days', []));

        if ($request->input('logo', false)) {
            if (!$pharmacy->logo || $request->input('logo') !== $pharmacy->logo->file_name) {
                if ($pharmacy->logo) {
                    $pharmacy->logo->delete();
                }

                $pharmacy->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
            }
        } elseif ($pharmacy->logo) {
            $pharmacy->logo->delete();
        }

        return (new PharmacyResource($pharmacy))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacy->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
