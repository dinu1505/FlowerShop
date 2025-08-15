<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'qty',
        'price',
        'total',
        'customer_name',
        'customer_email',
        'customer_address',
    ];
}
