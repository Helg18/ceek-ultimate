<?php

namespace Sellout;

use Sellout\Base;

class Address extends Base
{
    protected $fillable = [
        'name', 'line_1', 'line_2', 'line_3', 'city', 'state', 'zipcode', 'country',
        'shipping_address', 'billing_address', 'primary_shipping_address', 'primary_billing_address',
        'other_details',
    ];
    protected $casts = [
        'shipping_address' => 'boolean',
        'billing_address' => 'boolean',
        'primary_shipping_address' => 'boolean',
        'primary_billing_address' => 'boolean',
    ];
    public static function boot()
    {
        parent::boot();
        static::updating(function($address)
        {
            if(!is_null($address->user_id)) \Event::fire(new \App\Events\AddressUpdating($address));
        });
    }

    public function user()
    {
        return $this->belongsTo('Sellout\User');
    }
}
