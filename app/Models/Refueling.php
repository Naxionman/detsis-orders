<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refueling extends Model
{
    protected $guarded = [];

    protected $dates = [
        'refuel_date',
        
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }


}

