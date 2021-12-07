<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function invoices() {
        return $this->belongsToMany(Invoice::class);
    }
    
    public function orderDetails() {
        return $this->hasMany(OrderDetails::class);
    }
}
