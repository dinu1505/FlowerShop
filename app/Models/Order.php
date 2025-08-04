<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    'customer_name',
    'phone',
    'address',
    'flower_name',
    'quantity',
    'price',
    'total_price',
    'user_id'
];

}