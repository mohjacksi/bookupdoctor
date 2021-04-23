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
           return '{
            "data": [
              {
                "id": 1,
                "name": "بغداد"
              },
              {
                "id": 2,
                "name": "كركوك"
              },
              {
                "id": 3,
                "name": "الأنبار"
              },
              {
                "id": 4,
                "name": "البصرة"
              },
              {
                "id": 5,
                "name": "نينوى"
              },
              {
                "id": 6,
                "name": "أربيل"
              },
              {
                "id": 7,
                "name": "حلبجة"
              },
              {
                "id": 8,
                "name": "النجف"
              },
              {
                "id": 9,
                "name": "ذي قار"
              },
              {
                "id": 10,
                "name": "ديالى"
              },
              {
                "id": 11,
                "name": "المثنى"
              },
              {
                "id": 12,
                "name": "القادسية"
              },
              {
                "id": 13,
                "name": "ميسان"
              },
              {
                "id": 14,
                "name": "واسط"
              },
              {
                "id": 15,
                "name": "صلاح الدين"
              },
              {
                "id": 16,
                "name": "دهوك"
              },
              {
                "id": 17,
                "name": "السليمانية"
              },
              {
                "id": 18,
                "name": "بابل"
              },
              {
                "id": 19,
                "name": "كربلاء"
              }
            ]
          }';
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
