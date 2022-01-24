<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $guarded = [];
    protected $dates = ['expriry_date'];

    public function insurances(){
        return $this->belongsToMany(Insurance::class);
    }
    public function refuelings(){
        return $this->belongsToMany(Refueling::class);
    }
    public function kteos(){
        return $this->belongsToMany(Kteo::class);
    }
    public function car_services(){
        return $this->belongsToMany(CarService::class);
    }
}
