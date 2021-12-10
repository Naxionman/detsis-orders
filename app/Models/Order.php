<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    protected $dates = ['order_date','arrival_date'];

    public function orderDetails() {
        return $this->hasMany(OrderDetails::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
    
    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function shipment() {
        return $this->belongsTo(Shipment::class);
    }

    public function invoices() {
        return $this->belongsToMany(Invoice::class);
    }

}
