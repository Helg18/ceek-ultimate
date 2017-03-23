<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sold extends Model
{
    protected $fillable = ['buyer_id', 'product', 'amount', 'stripe_transaction_id'];
}
