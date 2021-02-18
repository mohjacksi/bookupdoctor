<?php

namespace App\Http\Requests;

use App\Models\AppointmentsStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAppointmentsStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointments_status_edit');
    }

    public function rules()
    {
        return [
            'name'  => [
                'string',
                'required',
                'unique:appointments_statuses,name,' . request()->route('appointments_status')->id,
            ],
            'color' => [
                'string',
                'required',
            ],
        ];
    }
}
