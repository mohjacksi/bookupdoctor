<?php

namespace App\Http\Requests;

use App\Models\Pharmacy;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePharmacyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pharmacy_edit');
    }

    public function rules()
    {
        return [
            'name'            => [
                'string',
                'required',
            ],
            'location'        => [
                'string',
                'required',
            ],
            'city_id'         => [
                'required',
                'integer',
            ],
            'days.*'          => [
                'integer',
            ],
            'days'            => [
                'required',
                'array',
            ],
            'latitude'        => [
                'numeric',
                'required',
            ],
            'longitude'       => [
                'numeric',
                'required',
            ],
            'expiration_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'phone_number'    => [
                'string',
                'required',
            ],
        ];
    }
}
