<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

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
        $kteo_expiring = DB::table('kteos')
                            ->select('next_kteo_date')
                            ->where('vehicle_id','=',$vehicleId)
                            ->latest()
                            ->first();
        $insurance_expiring = DB::table('insurances')
                            ->select('expiry_date')
                            ->where('vehicle_id','=',$vehicleId)
                            ->latest()
                            ->first();
        $last_service = DB::table('car_services')
                            ->select('service_date')
                            ->where('vehicle_id','=',$vehicleId)
                            ->latest()
                            ->first();

        $refuelings = DB::table('refuelings')->where('vehicle_id','=',$vehicleId)->get();

        return view('vehicles.view_vehicle', compact('vehicle','kteo_expiring', 'insurance_expiring','last_service', 'refuelings'));
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
