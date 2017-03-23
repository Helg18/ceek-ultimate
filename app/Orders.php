<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = ['client', 'address', 'email', 'total', 'payment_id'];
}
