<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
  
    public function details(){
        return $this->belongsToMany(OrderDetails::class);
    }

    public function prices(){
        return $this->belongsToMany(Price::class);
    }
}
