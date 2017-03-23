<?php

namespace App\Events;

use Sellout\User;
use App\Events\Event;
use Sellout\Transaction;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CardCharged extends Event
{
    use SerializesModels;

    public $user;
    public $transaction;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Transaction $transaction)
    {
        $this->user = $user;
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
