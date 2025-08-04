<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlowerCategory extends Model
{
    protected $fillable = ['name', 'icon_class'];
    
    public function flowers()
    {
        return $this->hasMany(Flower::class);
    }
}