<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [];

    protected $dates = ['shipping_date'];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function shipper() {
        return $this->belongsTo(Shipper::class);
    }
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function extraShipper() {
        return $this->belongsTo(Shipper::class);
    }
}
