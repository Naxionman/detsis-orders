<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $guarded = [];

    protected $dates = [
        'price_date',        
    ];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }


    public $timestamps = false;
}
