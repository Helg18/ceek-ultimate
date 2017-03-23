<?php

namespace App\Events;

use Sellout\User;
use Sellout\Catalog;
use Sellout\Purchase;
use App\Events\Event;
use Sellout\Transaction;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PurchaseCompleted extends Event
{
    use SerializesModels;

    public $catalog;
    public $user;
    public $purchase;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Catalog $catalog, Purchase $purchase, Transaction $transaction = null)
    {
        $this->catalog = $catalog;
        $this->user = $user;
        $this->purchase = $purchase;
        $this->transaction = $transaction;
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
}
