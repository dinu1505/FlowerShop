<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart'; // Name of your table

    protected $fillable = [
        'name',
        'qty',
        'price',
        'image', // Add other fields if your cart table has them
    ];

    public $timestamps = false; // If your table doesn't use created_at / updated_at
}
