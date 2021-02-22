<?php

namespace App\Http\Controllers\Admin;

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
use Yajra\DataTables\Facades\DataTables;

class DoctorsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Doctor::with(['specialties', 'days', 'city'])->select(sprintf('%s.*', (new Doctor)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'doctor_show';
                $editGate      = 'doctor_edit';
                $deleteGate    = 'doctor_delete';
                $crudRoutePart = 'doctors';

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
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : "";
            });
            $table->editColumn('specialties', function ($row) {
                $labels = [];

                foreach ($row->specialties as $specialty) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $specialty->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('stars', function ($row) {
                return $row->stars ? $row->stars : "";
            });
            $table->editColumn('is_special', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_special ? 'checked' : null) . '>';
            });
            $table->editColumn('is_active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_active ? 'checked' : null) . '>';
            });
            $table->addColumn('city_name', function ($row) {
                return $row->city ? $row->city->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'specialties', 'is_special', 'is_active', 'city']);

            return $table->make(true);
        }

        $specialties = Specialty::get();
        $days        = Day::get();
        $cities       = City::get();

        return view('admin.doctors.index', compact('specialties', 'days', 'cities'));
    }

    public function create()
    {
        abort_if(Gate::denies('doctor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialties = Specialty::all()->pluck('name', 'id');

        $days = Day::all();

        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.doctors.create', compact('specialties', 'days', 'cities'));
    }

    public function store(StoreDoctorRequest $request)
    {

        $doctor = Doctor::create($request->all());
        $doctor->specialties()->sync($request->input('specialties', []));
        //dd($request->input('days-evening', []));
        $days_morning = $request->input('days-morning', []);
        $days_evening = $request->input('days-evening', []);
        dd($days_evening );
        $doctor->days()->sync($this->daysMapper($days_morning,$days_evening));


        if ($request->input('image', false)) {
            $doctor->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $doctor->id]);
        }

        return redirect()->route('admin.doctors.index');
    }

    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialties = Specialty::all()->pluck('name', 'id');


        $cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctor->load('specialties', 'days', 'city');

        $days = Day::get()->map(function($day) use ($doctor) {
            $morning = data_get($doctor->days->firstWhere('id', $day->id), 'pivot.morning') ?? null;
            $evening = data_get($doctor->days->firstWhere('id', $day->id), 'pivot.evening') ?? null;
            $day->morning = $morning;

            $day->evening = $evening;
            return $day;
        });

        return view('admin.doctors.edit', compact('specialties', 'days', 'cities', 'doctor'));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->all());
        $doctor->specialties()->sync($request->input('specialties', []));


        //$doctor->days()->sync($request->input('days', []));
        $days_morning = $request->input('days-morning', []);
        $days_evening = $request->input('days-evening', []);
        //dd($this->daysMapper($days_morning,$days_evening));
        $doctor->days()->sync($this->daysMapper($days_morning,$days_evening));

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

        return redirect()->route('admin.doctors.index');
    }

    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->load('specialties', 'days', 'city', 'doctorPortfolios', 'doctorPayments');

        return view('admin.doctors.show', compact('doctor'));
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
    private function daysMapper($days_morning,$days_evening)
    {
        //dd($days_morning);
        return collect($days_morning)->map(function ($i,$j) use($days_evening) {
            return ['morning' => $i,'evening'=> $days_evening[$j]];
        });
    }
}



