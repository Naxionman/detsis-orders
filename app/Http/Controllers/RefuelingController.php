<?php

namespace App\Http\Controllers;

use App\Models\Refueling;
use App\Models\Vehicle;


class RefuelingController extends Controller {
    
    // Show all records of refuelings table
    public function index() {
        $refuelings = Refueling::all();

        return view('vehicles.fuel.refuelings', compact('refuelings'));
    }

    public function addFuel($vehicleId) {
        $vehicle = Vehicle::findOrFail($vehicleId);

        return view ('vehicles.fuel.add_fuel', compact('vehicle'));
    }
    
    public function store() {
        $data = request()->validate([
            'vehicle_id' => 'required',
            'refuel_date' => 'required',
            'amount' => 'required'
        ]);

        //dd($data);
        Refueling::create($data);
        $id = request()->input('vehicle_id');
        
        return redirect('view_vehicle/'.$id)->with('message', 'Επιτυχής προσθήκη ανεφοδιασμού!');
    }

    public function destroy(Refueling $refueling) {
        $refueling->delete();

        return redirect('refuelings')->with('message', 'Επιτυχής διαγραφή ανεφοδιασμού!');
    }
}