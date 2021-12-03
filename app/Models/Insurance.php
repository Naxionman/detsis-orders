<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $guarded = [];

    protected $dates = [
        'insurance_date',
        'expiry_date',
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
