<?php

namespace Sellout;

/**
 * Depricated class. Replaced by actual receipt model.
 */

class Receiptt
{
    public $sources = [];
    public $purchaseDate = null;
    public $purchasePath = null;
    public $name = null;
    public $shippingAddress = null;
    public $billingAddress = null;
    public $price = null;
    public $paid = null;
    public $charged = null;
    public $balance = null;
    public $promoCode = null;
    public $items = null;
    // public $description = null;

    public function make()
    {
        $this->_trimCruft();
        if($this->_hasRequiredDetails()) return $this;
        else throw new \Exception("Insufficient details to build a receipt.", 1);
    }
    private function _trimCruft()
    {
        foreach($this as $k => $v)
        {
            if($v === null) unset($this->{$k});
        }
    }
    private function _hasRequiredDetails()
    {
        $required = [
            'sources',
            'purchaseDate',
            'purchasePath',
            'name',
            'price',
            'paid',
            'charged',
            'balance',
            'items',
        ];
        foreach($required as $key)
        {
            if(!isset($this->{$key}) || $this->{$key} === null) return false;
        }
        return true;
    }
}
