<?php

namespace App\Events;

use Sellout\User;
use Sellout\Cart;
// use Sellout\Purchase;
use App\Events\Event;
use Sellout\Transaction;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CartPurchased extends Event
{
    use SerializesModels;

    public $cart;
    public $user;
    public $purchase;
    public $transaction;
    public $ships;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Cart $cart, $purchases, Transaction $transaction = null)
    {
        $this->cart = $cart;
        $this->user = $user;
        $this->purchases = $purchases;
        $this->transaction = $transaction;
        $this->ships = $this->_requiresShipping($cart);
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
    private function _requiresShipping($cart)
    {
        foreach($cart->catalogs as $catalog)
        {
            if($catalog->ships) return true;
        }
        return false;
    }
}
