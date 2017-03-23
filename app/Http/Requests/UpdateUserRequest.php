<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class UserUpdateRequest extends Request
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
            'email' => 'email|unique:users',
            'password' => 'min:6|confirmed',
            'dob' => 'date',
            'gender' => 'numeric|min:0|max:1'
        ];
        if($this['email'] === Auth::user()->email)
        {
            $rules['email'] = 'email';
        }
        return $rules;
    }
}
