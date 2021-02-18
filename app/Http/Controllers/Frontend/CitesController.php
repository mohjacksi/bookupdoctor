<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCiteRequest;
use App\Http\Requests\StoreCiteRequest;
use App\Http\Requests\UpdateCiteRequest;
use App\Models\Cite;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CitesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cites = Cite::all();

        return view('frontend.cites.index', compact('cites'));
    }

    public function create()
    {
        abort_if(Gate::denies('cite_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.cites.create');
    }

    public function store(StoreCiteRequest $request)
    {
        $cite = Cite::create($request->all());

        return redirect()->route('frontend.cites.index');
    }

    public function edit(Cite $cite)
    {
        abort_if(Gate::denies('cite_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.cites.edit', compact('cite'));
    }

    public function update(UpdateCiteRequest $request, Cite $cite)
    {
        $cite->update($request->all());

        return redirect()->route('frontend.cites.index');
    }

    public function show(Cite $cite)
    {
        abort_if(Gate::denies('cite_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cite->load('cityPharmacies', 'cityDoctors');

        return view('frontend.cites.show', compact('cite'));
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
