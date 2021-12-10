<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    //An OrderDetail has one Product
    public function product() {
        return $this->belongsTo(Product::class);
    }

    //An OrderDetail belongs to an Invoice
    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    //An OrderDetail belongs to an Order
    public function order() {
        return $this->belongsTo(Order::class);
    }
}
