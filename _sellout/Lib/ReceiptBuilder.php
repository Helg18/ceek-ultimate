<?php

namespace Sellout;

/**
 * Depricated - Receipt Builder class for single catalog purchases
 */
class ReceiptBuilder
{
    public $user;
    public $purchase;
    public $transaction;
    public $cart;
    public $purchases;

    public function create()
    {
        if(env('RECEIPTS_ENABLED', false) === false)
        {
            return false;
        }
        $receipt = Receipt::create([
            'purchased_at' => $this->_getPurchaseDate(),
            'purchase_path' => $this->_getPurchasePath(),
            'name' => $this->_getUserName(),
            'price' => $this->_getCatalogCost(),
            'paid' => $this->_getPurchaseCost(),
            'charged' => $this->_getCharged(),
            'promo_codes' => $this->_getPromoCodes(),
            'balance' => $this->_getUserBalance(),
            'billed_to' => $this->_getBillingAddress(),
            'shipped_to' => $this->_getShippingAddress(),
            'items' => $this->_getReceiptItems(),
            'purchases' => $this->_getPurchase(),
            'transaction' => $this->_getTransaction(),
            'user' => $this->user,
        ]);
        $receipt = $this->_associateRecords($receipt);
        return $receipt;
    }
    private function _associateRecords($receipt)
    {
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
    private function _getPromoCodes()
    {
        return !is_null($this->purchase->promo_code)
            ? [$this->purchase->promo_code]
            : null;
    }
    private function _getReceiptItems()
    {
        $items = [];
        foreach($this->cart as $catalog)
        {
            foreach($catalog->items as $item)
            {
                $items[$catalog->mid][] = $item->name;
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
    private function _getPurchasePath()
    {
        return $this->purchase->purchasePath;
    }
    private function _getPurchaseCost()
    {
        return $this->purchase->paid;
    }
    private function _getCatalogCost()
    {
        $sum = 0;
        foreach($this->cart as $catalog)
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
        return $this->purchase->created_at->toDateTimeString();
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
    private function _getPurchase()
    {
        return !is_null($this->purchase)
            ? $this->purchase
            : null;
    }
}
