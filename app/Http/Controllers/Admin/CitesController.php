<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCiteRequest;
use App\Http\Requests\StoreCiteRequest;
use App\Http\Requests\UpdateCiteRequest;
use App\Models\Cite;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CitesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('cite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Cite::query()->select(sprintf('%s.*', (new Cite)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'cite_show';
                $editGate      = 'cite_edit';
                $deleteGate    = 'cite_delete';
                $crudRoutePart = 'cites';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.cites.index');
    }

    public function create()
    {
        abort_if(Gate::denies('cite_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cites.create');
    }

    public function store(StoreCiteRequest $request)
    {
        $cite = Cite::create($request->all());

        return redirect()->route('admin.cites.index');
    }

    public function edit(Cite $cite)
    {
        abort_if(Gate::denies('cite_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cites.edit', compact('cite'));
    }

    public function update(UpdateCiteRequest $request, Cite $cite)
    {
        $cite->update($request->all());

        return redirect()->route('admin.cites.index');
    }

    public function show(Cite $cite)
    {
        abort_if(Gate::denies('cite_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cite->load('cityPharmacies', 'cityDoctors');

        return view('admin.cites.show', compact('cite'));
    }

    public function destroy(Cite $cite)
    {
        abort_if(Gate::denies('cite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cite->delete();

        return back();
    }

    public function massDestroy(MassDestroyCiteRequest $request)
    {
        Cite::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
