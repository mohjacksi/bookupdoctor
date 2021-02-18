<?php

namespace App\Http\Requests;

use App\Models\Cite;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCiteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cite_edit');
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