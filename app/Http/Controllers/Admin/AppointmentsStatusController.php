<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentsStatusRequest;
use App\Http\Requests\StoreAppointmentsStatusRequest;
use App\Http\Requests\UpdateAppointmentsStatusRequest;
use App\Models\AppointmentsStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsStatusController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('appointments_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AppointmentsStatus::query()->select(sprintf('%s.*', (new AppointmentsStatus)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'appointments_status_show';
                $editGate      = 'appointments_status_edit';
                $deleteGate    = 'appointments_status_delete';
                $crudRoutePart = 'appointments-statuses';

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
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.appointmentsStatuses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('appointments_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appointmentsStatuses.create');
    }

    public function store(StoreAppointmentsStatusRequest $request)
    {
        $appointmentsStatus = AppointmentsStatus::create($request->all());

        return redirect()->route('admin.appointments-statuses.index');
    }

    public function edit(AppointmentsStatus $appointmentsStatus)
    {
        abort_if(Gate::denies('appointments_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.appointmentsStatuses.edit', compact('appointmentsStatus'));
    }

    public function update(UpdateAppointmentsStatusRequest $request, AppointmentsStatus $appointmentsStatus)
    {
        $appointmentsStatus->update($request->all());

        return redirect()->route('admin.appointments-statuses.index');
    }

    public function show(AppointmentsStatus $appointmentsStatus)
    {
        abort_if(Gate::denies('appointments_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointmentsStatus->load('statusAppointments');

        return view('admin.appointmentsStatuses.show', compact('appointmentsStatus'));
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
