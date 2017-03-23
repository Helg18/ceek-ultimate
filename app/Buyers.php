<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyers extends Model
{    

    protected $table = 'buyers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['billing_name', 'billing_lastname', 'billing_email', 'billing_address',
    						'billing_country', 'billing_state' ,'billing_city', 'billing_zipcode', 'billing_phone'
    						'shipping_name', 'shipping_lastname', 'shipping_address', 'shipping_country',
    						'shipping_state', 'shipping_city' ,'shipping_zipcode', 'stripe_customer_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}
