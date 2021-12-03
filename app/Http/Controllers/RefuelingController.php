<?php

namespace App\Http\Controllers;

use App\Models\Refueling;
use Illuminate\Http\Request;

class RefuelingController extends Controller {
    
    // Show all records of refuelings table
    public function index() {
        $refuelings = \App\Models\Refueling::all();
        return view('vehicles.fuel.refuelings', compact('refuelings'));
    }

    public function add_fuel($vehicleId) {
        $vehicle = \App\Models\Vehicle::findOrFail($vehicleId);
        return view ('vehicles.fuel.add_fuel', compact('vehicle'));
    }
    
    public function store() {

        $data = request()->validate([
            'vehicle_id' => 'required',
            'refuel_date' => 'required',
            'amount' => 'required'
        ]);
        //dd($data);
        \App\Models\Refueling::create($data);
        $id = request()->input('vehicle_id');
        return redirect('view_vehicle/'.$id)->with('message', 'Επιτυχής προσθήκη ανεφοδιασμού!');
    }

    public function destroy(\App\Models\Refueling $refueling) {
        $refueling->delete();

        return redirect('refuelings')->with('message', 'Επιτυχής διαγραφή ανεφοδιασμού!');
    }

}
