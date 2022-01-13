<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $guarded = [];

    protected $dates =[
        'start_date',
        'last_date'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}