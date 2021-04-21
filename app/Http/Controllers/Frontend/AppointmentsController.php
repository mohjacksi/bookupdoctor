<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\AppointmentsStatus;
use App\Models\City;
use App\Models\Doctor;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Appointment::with(['status', 'user_city', 'doctor_city', 'doctor'])->select(sprintf('%s.*', (new Appointment())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'appointment_show';
                $editGate = 'appointment_edit';
                $deleteGate = 'appointment_delete';
                $crudRoutePart = 'appointments';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });

            $table->editColumn('time', function ($row) {
                return $row->time ? Appointment::TIME_SELECT[$row->time] : '';
            });
            $table->addColumn('status_name', function ($row) {
                return $row->status ? $row->status->name : '';
            });

            $table->addColumn('user_city_name', function ($row) {
                return $row->user_city ? $row->user_city->name : '';
            });

            $table->addColumn('doctor_city_name', function ($row) {
                return $row->doctor_city ? $row->doctor_city->name : '';
            });

            $table->addColumn('doctor_name', function ($row) {
                return $row->doctor ? $row->doctor->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'status', 'user_city', 'doctor_city', 'doctor']);

            return $table->make(true);
        }

        $appointments_statuses = AppointmentsStatus::get();
        $cities                 = City::get();
        $doctors               = Doctor::get();

        return view('admin.appointments.index', compact('appointments_statuses', 'cities', 'doctors'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = AppointmentsStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctor_cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appointments.create', compact('statuses', 'user_cities', 'doctor_cities', 'doctors'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->all());

        if ($request->input('voice', false)) {
            $appointment->addMedia(storage_path('tmp/uploads/' . basename($request->input('voice'))))->toMediaCollection('voice');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $appointment->id]);
        }

        return redirect()->route('admin.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = AppointmentsStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctor_cities = City::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointment->load('status', 'user_city', 'doctor_city', 'doctor');

        return view('admin.appointments.edit', compact('statuses', 'user_cities', 'doctor_cities', 'doctors', 'appointment'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());

        if ($request->input('voice', false)) {
            if (!$appointment->voice || $request->input('voice') !== $appointment->voice->file_name) {
                if ($appointment->voice) {
                    $appointment->voice->delete();
                }
                $appointment->addMedia(storage_path('tmp/uploads/' . basename($request->input('voice'))))->toMediaCollection('voice');
            }
        } elseif ($appointment->voice) {
            $appointment->voice->delete();
        }

        return redirect()->route('admin.appointments.index');
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('status', 'user_city', 'doctor_city', 'doctor');

        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        Appointment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('appointment_create') && Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Appointment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
