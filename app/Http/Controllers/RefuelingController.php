<?php

namespace App\Http\Controllers;

use App\Models\Refueling;
use Illuminate\Http\Request;

class RefuelingController extends Controller {
    
    public function add_fuel($vehicleId) {
        $vehicle = \App\Models\Vehicle::findOrFail($vehicleId);
        return view ('vehicles.add_fuel', compact('vehicle'));
    }
    
    public function store() {

        $data = request()->validate([
            'vehicle_id' => 'required',
            'refuel_date' => 'required',
            'amount' => 'required'
        ]);
        //dd($data);
        \App\Models\Refueling::create($data);
        
        return redirect('vehicles');
    }

}
