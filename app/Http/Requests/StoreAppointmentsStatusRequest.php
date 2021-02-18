<?php

namespace App\Http\Requests;

use App\Models\AppointmentsStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAppointmentsStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointments_status_create');
    }

    public function rules()
    {
        return [
            'name'  => [
                'string',
                'required',
                'unique:appointments_statuses',
            ],
            'color' => [
                'string',
                'required',
            ],
        ];
    }
}
