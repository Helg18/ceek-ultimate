<?php

namespace Sellout;

use Carbon\Carbon;

class ReceiptHandler
{

    public $user = null;
    public $transaction = null;
    public $cart = null;
    public $purchases = null;

    public function create()
    {
        if(env('RECEIPTS_ENABLED', false) !== true)
        {
            return false;
        }
        $receipt = Receipt::create([
            'purchased_at' => $this->_getPurchaseDate(),
            'name' => $this->_getUserName(),
            'price' => $this->_getCatalogCost(),
            'paid' => $this->_getCartCost(),
            'charged' => $this->_getCharged(),
            'promo_codes' => $this->_getPromoCodes(),
            'balance' => $this->_getUserBalance(),
            'billed_to' => $this->_getBillingAddress(),
            'shipped_to' => $this->_getShippingAddress(),
            'items' => $this->_getReceiptItems(),
            'purchases' => $this->_getPurchases(),
            'transaction' => $this->_getTransaction(),
            'user' => $this->user,
        ]);
        $receipt = $this->_associateRecords($receipt);
        return $receipt;
    }
    private function _associatePurchases($receipt)
    {
        if(!is_null($this->purchases))
        {
            foreach($this->purchases as $purchase)
            {
                $purchase->receipt()->associate($receipt);
                $purchase->save();
            }
        }
    }
    private function _associateRecords($receipt)
    {
        $this->_associatePurchases($receipt);
        $receipt->user()->associate($this->user);
        $receipt->save();
        return $receipt;
    }
    private function _getUserBalance()
    {
        return is_null($this->user->credits)
            ? 0
            : $this->user->credits;
    }
    private function _hasPromos()
    {
        if(!is_null($this->cart) && count($this->cart->promos) >= 1) return true;
        return false;
    }
    private function _getPromoCodes()
    {
        if(!$this->_hasPromos()) return null;
        $codes = [];
        foreach($this->cart->promos as $promo)
        {
            $codes[] = [
                'code' => $promo->code,
                'catalog' => $promo->promo->catalog_id,
                'promo' => $promo->promo->mid,
            ];
        }
        return $codes;
    }
    private function _getReceiptItems()
    {
        if(is_null($this->cart)) return [];
        $items = [];
        foreach($this->cart->catalogs as $idx => $catalog)
        {
            foreach($catalog->items as $item)
            {
                $items[$idx][$catalog->mid][] = $item->name;
            }
        }
        return $items;
    }
    private function _getCharged()
    {
        return !is_null($this->transaction)
            ? ($this->transaction->amount)
            : 0;
    }
    private function _getCartCost()
    {
        return !is_null($this->cart)
            ? $this->cart->total
            : 0;
    }
    private function _getCatalogCost()
    {
        if(is_null($this->cart) || count($this->cart->catalogs) < 1) return 0;
        $sum = 0;
        foreach($this->cart->catalogs as $catalog)
        {
            $sum += $catalog->cost;
        }
        return $sum;
    }
    private function _getUserName()
    {
        return $this->user->username;
    }
    private function _getPurchaseDate()
    {
        return Carbon::now()->toDateTimeString();
    }
    private function _getBillingAddress()
    {
        return !is_null($this->user->shipping_address_id)
            ? $this->user->billingAddress
            : null;
    }
    private function _getShippingAddress()
    {
        return !is_null($this->user->shipping_address_id)
            ? $this->user->shippingAddress
            : null;
    }
    private function _getTransaction()
    {
        return !is_null($this->transaction)
            ? $this->transaction
            : null;
    }
    private function _getPurchases()
    {
        return !is_null($this->purchases)
            ? $this->purchases
            : null;
    }
}
