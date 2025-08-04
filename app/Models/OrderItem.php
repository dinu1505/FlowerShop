<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'flower_id',
        'quantity',
        'price'
    ];
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function flower()
    {
        return $this->belongsTo(Flower::class);
    }
}
