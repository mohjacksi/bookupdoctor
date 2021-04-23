<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Resources\Admin\CityResource;
use App\Models\City;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CitiesApiController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('city_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $for_appointment = request()->for_appointment;
         if(isset($for_appointment))
           return '{"data":[{"id":1,"name":"\u0628\u063a\u062f\u0627\u062f"},{"id":2,"name":"\u0643\u0631\u0643\u0648\u0643"},{"id":3,"name":"\u0627\u0644\u0623\u0646\u0628\u0627\u0631"},{"id":4,"name":"\u0627\u0644\u0628\u0635\u0631\u0629"},{"id":5,"name":"\u0646\u064a\u0646\u0648\u0649"},{"id":6,"name":"\u0623\u0631\u0628\u064a\u0644"},{"id":7,"name":"\u062d\u0644\u0628\u062c\u0629"},{"id":8,"name":"\u0627\u0644\u0646\u062c\u0641"},{"id":9,"name":"\u0630\u064a \u0642\u0627\u0631"},{"id":10,"name":"\u062f\u064a\u0627\u0644\u0649"},{"id":11,"name":"\u0627\u0644\u0645\u062b\u0646\u0649"},{"id":12,"name":"\u0627\u0644\u0642\u0627\u062f\u0633\u064a\u0629"},{"id":13,"name":"\u0645\u064a\u0633\u0627\u0646"},{"id":14,"name":"\u0648\u0627\u0633\u0637"},{"id":15,"name":"\u0635\u0644\u0627\u062d \u0627\u0644\u062f\u064a\u0646"},{"id":16,"name":"\u062f\u0647\u0648\u0643"},{"id":17,"name":"\u0627\u0644\u0633\u0644\u064a\u0645\u0627\u0646\u064a\u0629"},{"id":18,"name":"\u0628\u0627\u0628\u0644"},{"id":19,"name":"\u0643\u0631\u0628\u0644\u0627\u0621"}]}';
         else
        
            return new CityResource(City::select(['id','name'])->get());
    }
    

    public function store(StoreCityRequest $request)
    {
        $city = City::create($request->all());

        return (new CityResource($city))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(City $city)
    {
        abort_if(Gate::denies('city_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CityResource($city);
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->all());

        return (new CityResource($city))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(City $city)
    {
        abort_if(Gate::denies('city_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
