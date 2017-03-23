<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersDetails extends Model
{
    protected $fillable = ['pro_id', 'ord_id', 'price', 'quantity'];
}
