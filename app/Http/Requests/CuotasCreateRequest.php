<?php

namespace TuFracc\Http\Requests;
use TuFracc\Http\Requests\Request;

class CuotasCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'concepto' => 'required',
            'amount' => 'required',
        ];
    }
}