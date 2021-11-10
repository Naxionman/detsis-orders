<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    use HasFactory;

    public function vehicle(){
        return $this->hasOne(Vehicle::class);
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
