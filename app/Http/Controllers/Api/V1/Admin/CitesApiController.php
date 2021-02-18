<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCiteRequest;
use App\Http\Requests\UpdateCiteRequest;
use App\Http\Resources\Admin\CiteResource;
use App\Models\Cite;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CitesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CiteResource(Cite::all());
    }

    public function store(StoreCiteRequest $request)
    {
        $cite = Cite::create($request->all());

        return (new CiteResource($cite))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Cite $cite)
    {
        abort_if(Gate::denies('cite_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CiteResource($cite);
    }

    public function update(UpdateCiteRequest $request, Cite $cite)
    {
        $cite->update($request->all());

        return (new CiteResource($cite))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Cite $cite)
    {
        abort_if(Gate::denies('cite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cite->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
