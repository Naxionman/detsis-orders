<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    // Defining One-To-Many relationship of Order->Products
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }

    public function orderShipments()
    {
        return $this->hasOne(OrderShipment::class);
    }

}
