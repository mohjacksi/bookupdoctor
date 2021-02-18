<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentsStatusRequest;
use App\Http\Requests\UpdateAppointmentsStatusRequest;
use App\Http\Resources\Admin\AppointmentsStatusResource;
use App\Models\AppointmentsStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appointments_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentsStatusResource(AppointmentsStatus::all());
    }

    public function store(StoreAppointmentsStatusRequest $request)
    {
        $appointmentsStatus = AppointmentsStatus::create($request->all());

        return (new AppointmentsStatusResource($appointmentsStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AppointmentsStatus $appointmentsStatus)
    {
        abort_if(Gate::denies('appointments_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AppointmentsStatusResource($appointmentsStatus);
    }

    public function update(UpdateAppointmentsStatusRequest $request, AppointmentsStatus $appointmentsStatus)
    {
        $appointmentsStatus->update($request->all());

        return (new AppointmentsStatusResource($appointmentsStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AppointmentsStatus $appointmentsStatus)
    {
        abort_if(Gate::denies('appointments_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentsStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
