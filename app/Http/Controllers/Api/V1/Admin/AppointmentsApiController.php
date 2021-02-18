<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\Admin\AppointmentResource;
use App\Models\Appointment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('appointment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentResource(Appointment::with(['status'])->get());
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->all());

        if ($request->input('voice', false)) {
            $appointment->addMedia(storage_path('tmp/uploads/' . $request->input('voice')))->toMediaCollection('voice');
        }

        return (new AppointmentResource($appointment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentResource($appointment->load(['status']));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());

        if ($request->input('voice', false)) {
            if (!$appointment->voice || $request->input('voice') !== $appointment->voice->file_name) {
                if ($appointment->voice) {
                    $appointment->voice->delete();
                }

                $appointment->addMedia(storage_path('tmp/uploads/' . $request->input('voice')))->toMediaCollection('voice');
            }
        } elseif ($appointment->voice) {
            $appointment->voice->delete();
        }

        return (new AppointmentResource($appointment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}