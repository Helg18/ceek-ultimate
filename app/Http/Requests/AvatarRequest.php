<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AvatarRequest extends Request
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
            'Gender' => 'numeric',
            'Hair' => 'numeric',
            'EyeColor' => 'numeric',
            'SkinColor' => 'numeric',
            'Tops' => 'numeric',
            'Bottoms' => 'numeric',
            'Shoes' => 'numeric'
        ];
        return $rules;
    }
}