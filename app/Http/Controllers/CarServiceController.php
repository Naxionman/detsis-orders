<?php

namespace App\Http\Controllers;

use App\Models\CarService;
use Illuminate\Http\Request;

class CarServiceController extends Controller {

    // Show all records of refuelings table
    public function index() {
        $car_services = \App\Models\CarService::all();
        return view('vehicles.car_service.car_services', compact('car_services'));
    }

    public function add_car_service($vehicleId) {
        $vehicle = \App\Models\Vehicle::findOrFail($vehicleId);
        return view ('vehicles.car_service.add_car_service', compact('vehicle'));
    }
    
    public function store() {

        $data = request()->validate([
            'vehicle_id' => 'required',
            'service_date' => 'required',
            'garage' => 'required',
            'description' => 'required',
            'amount' => 'required'
        ]);
        //dd($data);
        \App\Models\CarService::create($data);
        $id = request()->input('vehicle_id');
        return redirect('view_vehicle/'.$id)->with('message', 'Επιτυχής προσθήκη service/επισκευής!');
    }

    public function destroy(\App\Models\CarService $carService) {
        $carService->delete();

        return redirect('car_Services')->with('message', 'Επιτυχής διαγραφή services/επισκευής!');
    }
}
