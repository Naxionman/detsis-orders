<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Vehicle;
use App\Models\Kteo;
use App\Models\CarService;
use App\Models\Insurance;
use App\Models\Refueling;
use DateTime;

class VehicleController extends Controller {

    // Show all records of vehicles table
    public function index() {
        $vehicles = Vehicle::all();
        $insurances = Insurance::all();

        //Showcasing different approaches
        $expiry_dates = collect();
        $expires_in = array();
        $today = new DateTime('21-1-2022');
        
        foreach ($vehicles as $vehicle) {
            $vehicle_insurance = Insurance::where('vehicle_id','=',$vehicle->id)
                            ->latest()
                            ->first();
            if($vehicle_insurance == null){
                $expiry_dates->push('Δεν έχει καταγραφεί κάποια ασφάλιση');
                $expires_in[$vehicle->id -1] = null ;
            } else{
                $expiry_dates->push($vehicle_insurance->expiry_date);

                $due = new DateTime($vehicle_insurance->expiry_date);
                $interval = $due->diff( $today);
                
                $expires_in[$vehicle->id -1] = $interval ;
            }                         
        }
        //dd($expires_in);
        //dd($expiry_dates);
        
        return view('vehicles.vehicles', compact('vehicles','expiry_dates','expires_in'));    }

    public function addVehicle() {

        return view ('vehicles.add_vehicle');
    }
    
    public function store() {
        $data = request()->validate([
            'name' => 'required|unique:vehicles|min:4'
        ]);

        Vehicle::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση Οχήματος!');
    }

    public function show($vehicleId) {
        $vehicle = Vehicle::findOrFail($vehicleId);
        
        return view('vehicles.edit_vehicle', compact('vehicle'));
    }

    public function showDetails($vehicleId) {
        $vehicle = Vehicle::findOrFail($vehicleId);

        $kteo = Kteo::select('next_kteo_date')
                            ->where('vehicle_id','=',$vehicleId)
                            ->latest()
                            ->first();
                            
        $insurance = Insurance::select('expiry_date')
                            ->where('vehicle_id','=',$vehicleId)
                            ->latest()
                            ->first();

        $last_service = CarService::select('service_date')
                            ->where('vehicle_id','=',$vehicleId)
                            ->latest()
                            ->first();
        $today = Date('Y-m-d');
        if($last_service == null){
            $days = 0;
        } else{
            $days = $last_service->diff($today, $last_service);
        }

        $car_refuelings = Refueling::where('vehicle_id','=',$vehicleId)->orderBy('id', 'ASC')->get();
        
        $car_services = CarService::where('vehicle_id','=',$vehicleId)->orderBy('id', 'ASC')->get();
        
        return view('vehicles.view_vehicle', compact('vehicle','kteo', 'insurance','days', 'car_refuelings','car_services'));
    }

    public function update(Vehicle $vehicle) {
        $data = request()->validate([
            'name' => 'required|min:4',
            'plate' => 'required|min:7',
            'fuel_type' => 'required',  
            'notes' => 'nullable'  
        ]);

        $vehicle->update($data);
        
        return redirect('vehicles')->with('message', 'Επιτυχής επεξεργασία βασικών στοιχείων οχήματος!');
    }

    public function destroy(Vehicle $vehicle) {
        $vehicle->delete();

        return redirect('vehicles')->with('message', 'Επιτυχής διαγραφή οχήματος!');
    }
}