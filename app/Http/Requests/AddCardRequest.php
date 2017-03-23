<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddCardRequest extends Request
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
        $rules = [
            'name' => 'required',
            'number' => 'required|numeric|digits_between:15,16',
            'exp_month' => 'required|numeric|min:1|max:12',
            'exp_year' => 'required|numeric',
            'cvc' => 'required|numeric|digits_between:3,4'
        ];
        return $rules;
    }
}
