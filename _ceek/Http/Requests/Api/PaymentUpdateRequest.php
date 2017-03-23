<?php

namespace Ceek\Http\Requests\Api;

use Auth;
use App\Http\Requests\Request;

class PaymentUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'stripeToken' => 'required'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'stripeToken.required' => 'The stripeToken field is required.'
        ];
    }
}
