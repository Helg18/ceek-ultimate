<?php

namespace App\Events;

use Sellout\User;
use Sellout\Address;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AddressUpdating extends Event
{
    use SerializesModels;

    public $address;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Address $address, User $user = null)
    {
        $this->address = $address;
        $this->user = is_null($user)
            ? $this->_getUser()
            : $user;
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
    private function _getUser()
    {
        return is_null($this->address->user_id)
            ? null
            : User::find($this->address->user_id);
    }
}
