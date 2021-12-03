<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarService extends Model
{
    protected $guarded = [];

    protected $dates = [
        'service_date',
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
