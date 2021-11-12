<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $dates = [
        'date_of_birth',
        'contract_expiring',
        'date_joined',
        'date_left',

    ];

    public function dispatches(){
        return $this->belongsToMany(Dispatch::class);
    }
   
}
