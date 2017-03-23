<?php

namespace App\Listeners;

use App\Events\AddressUpdating;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetAddressDefaults
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AddressCreated  $event
     * @return void
     */
    public function handle(AddressUpdating $event)
    {
        $hasPrimaryBilling = !is_null($event->user->billing_address_id);
        $hasPrimaryShipping = !is_null($event->user->shipping_address_id);
        if(!$hasPrimaryBilling) $this->_setPrimaryBilling($event->user, $event->address);
        if(!$hasPrimaryShipping) $this->_setPrimaryShipping($event->user, $event->address);
        if($event->user->isDirty()) $event->user->save();
    }
    private function _setPrimaryShipping(&$user, $address)
    {
        if($address->shipping_address)
        {
            $user->shippingAddress()->associate($address);
        }
    }
    private function _setPrimaryBilling(&$user, $address)
    {
        if($address->billing_address)
        {
            $user->billingAddress()->associate($address);
        }
    }
}
