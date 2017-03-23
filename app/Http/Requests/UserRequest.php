<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
            'username' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|confirmed',
            'dob' => 'date',
            'gender' => 'numeric|min:0|max:1',
        ];
        return $rules;
    }
}
