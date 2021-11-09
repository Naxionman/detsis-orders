<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // Show all records of vehicles table
    public function index()
    {
        $vehicles = \App\Models\Vehicle::all();
        return view('vehicles.vehicles', compact('vehicles'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|unique:vehicles|min:4'
            
        ]);

        \App\Models\Vehicle::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση Οχήματος!');
    }

    public function show($vehicleId)
    {
        $vehicle = \App\Models\Vehicle::findOrFail($vehicleId);
        //dd($vehicle);
        return view('vehicles.edit_vehicle', compact('vehicle'));
    }

    public function update(\App\Models\Vehicle $vehicle)
    {
        //dd($vehicle);

        $data = request()->validate([
            'name' => 'required|min:4',
            
        ]);

        $vehicle->update($data);
        //dd($vehicle->name);
        
        $vehicles = \App\Models\Vehicle::all();
        return view('vehicles', compact('vehicles'));
    }

    public function destroy(\App\Models\Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect('vehicles');
    }
}
