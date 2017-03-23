<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddressRequest extends Request
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
        $this->_requireShippingOrBilling();
        $rules = [
            'name' => 'required',
            'line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required|numeric|digits_between:5,8',
            'country' => 'required',
            'shipping_address' => 'boolean|required_without:billing_address|require_shipping_or_billing',
            'billing_address' => 'boolean|required_without:shipping_address|require_shipping_or_billing',
        ];
        return $rules;
    }
    private function _requireShippingOrBilling()
    {
        $type = \Request::only('billing_address', 'shipping_address');
        $passed = false;
        foreach($type as $v)
        {
            if($v === true) $passed = true;
        }
        \Validator::extend('require_shipping_or_billing', function($attribute, $value, $parameters) use ($passed)
        {
            return $passed;
        });
    }
}
