<?php

namespace App\Http\Requests;

use App\Models\Doctor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('doctor_edit');
    }

    public function rules()
    {
        return [
            'name'            => [
                'string',
                'required',
            ],
            'phone_number'    => [
                'string',
                'required',
            ],
            'location'        => [
                'string',
                'required',
            ],
            'days.*'          => [
                'integer',
            ],
            'days-morning.*'          => [
                'string',
            ],
            'days-evening.*'          => [
                'string',
            ],
            'days'            => [
                // 'required',
                'array',
            ],
            'stars'           => [
                'numeric',
                'min:0',
                'max:5',
            ],
            'expiration_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'latitude'        => [
                'numeric',
                'required',
            ],
            'longitude'       => [
                'numeric',
                'required',
            ],
            'city_id'         => [
                'required',
                'integer',
            ],
            'specialties.*'   => [
                'integer',
            ],
            'specialties'     => [
                'required',
                'array',
            ],
        ];
    }
}
