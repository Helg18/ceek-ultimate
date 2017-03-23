<?php

namespace Sellout;

use Sellout\Base;
use Sellout\User;
use Sellout\PurchaseHandler;

/**
 * Describes the purchase history of catalog items.
 */

class Purchase extends Base
{
    protected $casts = [
        'paid' => 'integer',
    ];
    public function user()
    {
        return $this->belongsTo('Sellout\User');
    }
    public function receipt()
    {
        return $this->belongsTo('Sellout\Receipt');
    }
    public static function buy(User $user, $id)
    {
        $purchase = new PurchaseHandler($user, $id);
        return $purchase;
    }
    public static function buyDirect(User $user, $id, $useExistingCredits = true)
    {
        $purchase = new PurchaseHandler($user, $id, true, $useExistingCredits);
        return $purchase;
    }
    public static function buyDirectFull(User $user, $id, $useExistingCredits = false)
    {
        $purchase = new PurchaseHandler($user, $id, true, $useExistingCredits);
        return $purchase;
    }
}
