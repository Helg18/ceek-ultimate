<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MegadethRegBuyRequest extends Request
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
            //Registration rules
            'username' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|confirmed',
            'dob' => 'required|date',
            'gender' => 'required|numeric|min:0|max:1',
            //CC rules
            'name' => 'required',
            'number' => 'required|numeric|digits_between:15,16',
            'exp_month' => 'required|numeric|min:1|max:12',
            'exp_year' => 'required|numeric',
            'cvc' => 'required|numeric|digits_between:3,4'
        ];
        return $rules;
    }
}
