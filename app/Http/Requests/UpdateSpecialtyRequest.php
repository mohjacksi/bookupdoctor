<?php

namespace App\Http\Requests;

use App\Models\Specialty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSpecialtyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('specialty_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
