<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arrangement extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image'];
}
