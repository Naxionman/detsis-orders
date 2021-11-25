<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [];

    public function shipper() {
        return $this->belongsTo(Shipper::class);
    }

    public function extraShipper() {
        return $this->belongsTo(Shipper::class);
    }
}
