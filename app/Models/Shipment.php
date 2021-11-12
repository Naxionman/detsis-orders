<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [];

    public function shippers()
    {
        return $this->hasMany(Shipper::class);
    }
}
