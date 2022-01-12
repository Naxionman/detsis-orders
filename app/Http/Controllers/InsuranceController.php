<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class InsuranceController extends Controller {

    public function index() {
        $insurances = Insurance::all();

        return view('vehicles.insurance.insurances', compact('insurances'));
    }

    public function addInsurance($vehicleId) {
        $vehicle = Vehicle::findOrFail($vehicleId);
        
        return view ('vehicles.insurance.add_insurance', compact('vehicle'));
    }
    
    public function store() {
        $data = request()->validate([
            'vehicle_id' => 'required',
            'insurance_date' => 'required',
            'expiry_date' => 'required',
            'insurance_company' => 'required',
            'amount' => 'required'
        ]);
        
        //dd($data);
        Insurance::create($data);
        $id = request()->input('vehicle_id');
        
        return redirect('view_vehicle/'.$id)->with('message', 'Επιτυχής ανανέωση ασφάλισης!');
    }

    public function destroy(Insurance $insurance) {
        $insurance->delete();

        return redirect('insurances')->with('message', 'Επιτυχής διαγραφή ασφάλισης!');
    }
}