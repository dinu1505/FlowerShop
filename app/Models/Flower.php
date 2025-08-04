<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    protected $fillable = [
        'name', 
        'category', 
        'description', 
        'price',
        'sale_price',
        'image_path',
        'is_new',
        'is_on_sale'
    ];
    
    public function category()
    {
        return $this->belongsTo(FlowerCategory::class);
    }
}