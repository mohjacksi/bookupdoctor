<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class PharmaciesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('pharmacy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Pharmacy::with(['city', 'days'])->select(sprintf('%s.*', (new Pharmacy)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'pharmacy_show';
                $editGate      = 'pharmacy_edit';
                $deleteGate    = 'pharmacy_delete';
                $crudRoutePart = 'pharmacies';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : "";
            });
            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->editColumn('is_special', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_special ? 'checked' : null) . '>';
            });
            $table->editColumn('is_active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_active ? 'checked' : null) . '>';
            });

            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'city', 'is_special', 'is_active']);

            return $table->make(true);
        }

        $cites = Cite::get();
        $days  = Day::get();

        return view('admin.pharmacies.index', compact('cites', 'days'));
    }

    public function create()
    {
        abort_if(Gate::denies('pharmacy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = Cite::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $days = Day::all();

        return view('admin.pharmacies.create', compact('cities', 'days'));
    }

    public function store(StorePharmacyRequest $request)
    {
        $pharmacy = Pharmacy::create($request->all());
        $days_morning = $request->input('days-morning', []);
        $days_evening = $request->input('days-evening', []);
        //dd($this->daysMapper($days_morning,$days_evening));
        $pharmacy->days()->sync($this->daysMapper($days_morning,$days_evening));

        if ($request->input('logo', false)) {
            $pharmacy->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pharmacy->id]);
        }

        return redirect()->route('admin.pharmacies.index');
    }

    public function edit(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = Cite::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        $pharmacy->load('city', 'days');

        $days = Day::get()->map(function($day) use ($pharmacy) {
            $morning = data_get($pharmacy->days->firstWhere('id', $day->id), 'pivot.morning') ?? null;
            $evening = data_get($pharmacy->days->firstWhere('id', $day->id), 'pivot.evening') ?? null;
            $day->morning = $morning;
            $day->evening = $evening;
            return $day;
        });
        //dd($days);
        return view('admin.pharmacies.edit', compact('cities', 'days', 'pharmacy'));
    }

    public function update(UpdatePharmacyRequest $request, Pharmacy $pharmacy)
    {
        $pharmacy->update($request->all());

        $days_morning = $request->input('days-morning', []);
        $days_evening = $request->input('days-evening', []);
        $pharmacy
        ->days()->sync($this->daysMapper($days_morning,$days_evening));

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

        return redirect()->route('admin.pharmacies.index');
    }

    public function show(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacy->load('city', 'days', 'pharmacyPayments');

        return view('admin.pharmacies.show', compact('pharmacy'));
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
    private function daysMapper($days_morning,$days_evening)
    {
        //dd($days_morning);
        return collect($days_morning)->map(function ($i,$j) use($days_evening) {
            return ['morning' => $i,'evening'=> $days_evening[$j]];
        });
    }
}
