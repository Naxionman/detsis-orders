<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Show all records of vehicles table
    public function index() {
        $vehicles = \App\Models\Vehicle::all();
        
        return view('vehicles.vehicles', compact('vehicles'));
    }

    public function add_vehicle() {
        return view ('vehicles.add_vehicle');
    }
    
    public function store() {
        $data = request()->validate([
            'name' => 'required|unique:vehicles|min:4'
            
        ]);

        \App\Models\Vehicle::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση Οχήματος!');
    }

    public function show($vehicleId) {
        $vehicle = \App\Models\Vehicle::findOrFail($vehicleId);
        
        return view('vehicles.edit_vehicle', compact('vehicle'));
    }

    public function showDetails($vehicleId) {
        $vehicle = \App\Models\Vehicle::findOrFail($vehicleId);
        $kteos = \App\Models\Kteo::where('vehicle_id','=','$vehicleId');
        $car_services = \App\Models\CarService::where('vehicle_id','=','$vehicleId');
        $insurances = \App\Models\Insurance::where('vehicle_id','=','$vehicleId');
        $refuelings = \App\Models\Refueling::where('vehicle_id','=','$vehicleId');

        return view('vehicles.view_vehicle', compact('vehicle','kteos', 'car_services', 'insurances', 'refuelings'));
    }

    public function update(\App\Models\Vehicle $vehicle) {
        $data = request()->validate([
            'name' => 'required|min:4',
            'plate' => 'required|min:7',
            'fuel_type' => 'required',  
            'notes' => 'nullable'  
        ]);

        $vehicle->update($data);
        
        return redirect('vehicles');
        
    }

    public function destroy(\App\Models\Vehicle $vehicle) {
        $vehicle->delete();

        return redirect('vehicles');
    }
}
