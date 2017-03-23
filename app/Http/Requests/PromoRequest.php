<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PromoRequest extends Request
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
            'codes' => 'required|numeric|between:1,25000',
            'catalog_id' => 'required',
            'promo_cost' => 'required|numeric|min:0',
            'starts' => 'required|date',
            'expires' => 'required|'.$this->_expDate(),
        ];
        return $rules;
    }
    private function _expDate()
    {
        if(strtolower($this->expires) === 'never')
        {
            return 'alpha';
        }
        elseif($this->expires === false)
        {
            return 'boolean';
        }
        return 'date';
    }
}
