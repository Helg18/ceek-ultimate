<?php

namespace Ceek\Http\Requests\Api;

use Auth;
use App\Http\Requests\Request;

class PaymentChargeRequest extends Request
{
    protected $messages = [
        'mid' => ['exists' => 'lskjdflkjsflksj'],
        'mid.exists' => 'sdkldsjlfsjd'
    ];
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
            'mid' => 'required|exists:catalogs'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'mid.exists' => 'The provided mid does not exist in the catalog.'
        ];
    }
}
