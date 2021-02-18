<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPharmacyRequest;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Models\Cite;
use App\Models\Day;
use App\Models\Pharmacy;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PharmaciesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pharmacy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacies = Pharmacy::with(['city', 'days', 'media'])->get();

        $cites = Cite::get();

        $days = Day::get();

        return view('frontend.pharmacies.index', compact('pharmacies', 'cites', 'days'));
    }

    public function create()
    {
        abort_if(Gate::denies('pharmacy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = Cite::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $days = Day::all()->pluck('name', 'id');

        return view('frontend.pharmacies.create', compact('cities', 'days'));
    }

    public function store(StorePharmacyRequest $request)
    {
        $pharmacy = Pharmacy::create($request->all());
        $pharmacy->days()->sync($request->input('days', []));

        if ($request->input('logo', false)) {
            $pharmacy->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pharmacy->id]);
        }

        return redirect()->route('frontend.pharmacies.index');
    }

    public function edit(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = Cite::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $days = Day::all()->pluck('name', 'id');

        $pharmacy->load('city', 'days');

        return view('frontend.pharmacies.edit', compact('cities', 'days', 'pharmacy'));
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

        return redirect()->route('frontend.pharmacies.index');
    }

    public function show(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacy->load('city', 'days', 'pharmacyPayments');

        return view('frontend.pharmacies.show', compact('pharmacy'));
    }

    public function destroy(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacy->delete();

        return back();
    }

    public function massDestroy(MassDestroyPharmacyRequest $request)
    {
        Pharmacy::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('pharmacy_create') && Gate::denies('pharmacy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Pharmacy();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
