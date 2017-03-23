<?php

namespace Sellout;

use Sellout\Base;

/**
 * Describes a user's Stripe transaction history.
 */

class Transaction extends Base
{
    protected $fillable = [
        'charge_id',
        'object',
        'created',
        'livemode',
        'paid',
        'status',
        'amount',
        'currency',
        'refunded',
        'captured',
        'balance_transaction',
        'amount_refunded',
        'customer',
        'fraud_details'
    ];
    public function user()
    {
        return $this->belongsTo('Sellout\User');
    }

}
