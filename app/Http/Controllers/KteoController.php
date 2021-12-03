<?php

namespace App\Http\Controllers;

use App\Models\Kteo;
use Illuminate\Http\Request;

class KteoController extends Controller {
    
    // Show all records of ΚΤΕΟs table
    public function index() {
        $kteos = \App\Models\Kteo::all();
        return view('vehicles.kteo.kteos', compact('kteos'));
    }

    public function add_kteo($vehicleId) {
        $vehicle = \App\Models\Vehicle::findOrFail($vehicleId);
        return view ('vehicles.kteo.add_kteo', compact('vehicle'));
    }
    
    public function store() {

        $data = request()->validate([
            'vehicle_id' => 'required',
            'kteo_date' => 'required',
            'next_kteo_date' => 'required',
            'amount' => 'required'
        ]);
        //dd($data);
        \App\Models\Kteo::create($data);
        $id = request()->input('vehicle_id');
        return redirect('view_vehicle/'.$id)->with('message', 'Επιτυχής προσθήκη KTEO!');
    }

    public function destroy(\App\Models\Kteo $kteo) {
        $kteo->delete();

        return redirect('kteos')->with('message', 'Επιτυχής διαγραφή KTEO!');
    }
}
