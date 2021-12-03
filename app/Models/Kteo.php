<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kteo extends Model
{
    protected $guarded = [];

    protected $dates = [
        'kteo_date',
        'next_kteo_date'
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
