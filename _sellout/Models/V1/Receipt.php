<?php

namespace Sellout;

use Sellout\Base;

class Receipt extends Base
{
    protected $casts = [
        'items' => 'object',
        'promo_codes' => 'array',
        'user' => 'object',
        'purchases' => 'object',
        'transaction' => 'object',
        'billed_to' => 'object',
        'shipped_to' => 'object',
    ];
    protected $fillable = [
        'purchased_at', 'purchase_path', 'items',
        'name', 'price', 'paid', 'charged', 'promo_codes', 'balance',
        'billed_to', 'shipped_to', 'transaction', 'purchases', 'user',
    ];
    public function user()
    {
        return $this->belongsTo('Sellout\User');
    }
}
