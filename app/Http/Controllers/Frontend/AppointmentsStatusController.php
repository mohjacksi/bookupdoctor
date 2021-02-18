<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentsStatusRequest;
use App\Http\Requests\StoreAppointmentsStatusRequest;
use App\Http\Requests\UpdateAppointmentsStatusRequest;
use App\Models\AppointmentsStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentsStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('appointments_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentsStatuses = AppointmentsStatus::all();

        return view('frontend.appointmentsStatuses.index', compact('appointmentsStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('appointments_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.appointmentsStatuses.create');
    }

    public function store(StoreAppointmentsStatusRequest $request)
    {
        $appointmentsStatus = AppointmentsStatus::create($request->all());

        return redirect()->route('frontend.appointments-statuses.index');
    }

    public function edit(AppointmentsStatus $appointmentsStatus)
    {
        abort_if(Gate::denies('appointments_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.appointmentsStatuses.edit', compact('appointmentsStatus'));
    }

    public function update(UpdateAppointmentsStatusRequest $request, AppointmentsStatus $appointmentsStatus)
    {
        $appointmentsStatus->update($request->all());

        return redirect()->route('frontend.appointments-statuses.index');
    }

    public function show(AppointmentsStatus $appointmentsStatus)
    {
        abort_if(Gate::denies('appointments_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentsStatus->load('statusAppointments');

        return view('frontend.appointmentsStatuses.show', compact('appointmentsStatus'));
    }

    public function destroy(AppointmentsStatus $appointmentsStatus)
    {
        abort_if(Gate::denies('appointments_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentsStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyAppointmentsStatusRequest $request)
    {
        AppointmentsStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
