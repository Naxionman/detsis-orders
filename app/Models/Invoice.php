<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    protected $dates = ['order_date','arrival_date', 'invoice_date','shipping_date'];

    public function shipment(){
        return $this->belongsTo(Shipment::class);
    }
    
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }
    
    public function orderDetails() {
        return $this->hasMany(OrderDetails::class);
    }
}
