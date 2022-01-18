<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    protected $guarded = [];

    protected $dates = ['payment_date'];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}