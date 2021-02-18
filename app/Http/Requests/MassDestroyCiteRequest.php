<?php

namespace App\Http\Requests;

use App\Models\Cite;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCiteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cites,id',
        ];
    }
}
