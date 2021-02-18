<?php

namespace App\Http\Requests;

use App\Models\Portfolio;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePortfolioRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('portfolio_edit');
    }

    public function rules()
    {
        return [
            'title'       => [
                'string',
                'required',
            ],
            'desecration' => [
                'required',
            ],
            'doctor_id'   => [
                'required',
                'integer',
            ],
        ];
    }
}
