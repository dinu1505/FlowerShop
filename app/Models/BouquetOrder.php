<?php

namespace App\Models;

use App\Models\BouquetOrder;
use Illuminate\Database\Eloquent\Model;

class BouquetOrder extends Model
{
   
    protected $fillable = [
        'product_name',
        'price',
        'quantity',
    ];
}
