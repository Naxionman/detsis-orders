<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    protected $guarded = [];

    protected $dates = [
        'dispatch_date',
        'updated_at',
        'deleted_at'
    ];

    public function vehicle(){
        return $this->hasOne(Vehicle::class);
    }

    public function employees(){
        return $this->belongsToMany(Employee::class);
    }
}
