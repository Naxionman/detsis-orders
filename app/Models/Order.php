<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    protected $dates = ['order_date','arrival_date'];

    // Defining One-To-Many relationship of Order->Products
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function orderShipments()
    {
        return $this->hasOne(OrderShipment::class);
    }

}
