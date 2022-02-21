<?php

namespace App\Http\Controllers;

use App\Models\Shipper;
use App\Models\Shipment;
class ShipperController extends Controller {

    // Show all records of shippers table
    public function index() {
        $shippers = Shipper::all();
        $shipments = Shipment::all();

        return view('shippers.shippers', compact('shippers', 'shipments'));
    }

    public function addShipper() {

        return view ('shippers.add_shipper');
    }

    public function store() {
        $data = request()->validate([
            'name' => 'required|unique:shippers|min:4',
            'phone' => 'nullable',
            'email'=> 'nullable',
            'website' => 'nullable',
        ]);

        Shipper::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση Μεταφορικής!');
    }

    public function show($shipperId) {
        $shipper = Shipper::findOrFail($shipperId);
        //dd($shipper);

        return view('shippers.edit_shipper', compact('shipper'));
    }

    public function showDetails($shipperId, $selected_year) {
        $shipper = Shipper::findOrFail($shipperId);
        $shipments = Shipment::where('shipper_id',$shipperId)->get();
        
        $min_year = Shipment::min('shipping_date');
        $max_year = Shipment::max('shipping_date');
        $min_year = (int) date('Y', strtotime($min_year));
        $max_year = (int) date('Y', strtotime($max_year));

        
        
        $shipments_per_year = array();
        for($year = $min_year; $year < $max_year+1; $year++){
            //Avoiding Undefined array key 2022,thus initializing the arrays (because not all shippers have already been used in each year...)
            $shipments_per_year[$year] = array();
            
            $shipments_per_month = array(
                array("month"=>"Ιανουάριος", "count"=>0,"charges"=>0),     
                array("month"=>"Φεβρουάριος", "count"=>0,"charges"=>0),     
                array("month"=>"Μάρτιος", "count"=>0,"charges"=>0),     
                array("month"=>"Απρίλιος", "count"=>0,"charges"=>0),     
                array("month"=>"Μάιος", "count"=>0,"charges"=>0),     
                array("month"=>"Ιούνιος", "count"=>0,"charges"=>0),     
                array("month"=>"Ιούλιος", "count"=>0,"charges"=>0),     
                array("month"=>"Αύγουστος", "count"=>0,"charges"=>0),     
                array("month"=>"Σεπτέμβριος", "count"=>0,"charges"=>0),     
                array("month"=>"Οκτώβριος", "count"=>0,"charges"=>0),     
                array("month"=>"Νοέμβριος", "count"=>0,"charges"=>0),     
                array("month"=>"Δεκέμβριος", "count"=>0,"charges"=>0),     
            );
            //
            for ($i=1; $i < 13; $i++) { 
                foreach ($shipments as $shipment) {
                    if($shipment->shipping_date->month == $i && $shipment->shipping_date->year == $year){
                        $shipments_per_month[$i-1]["count"] +=1;
                        $shipments_per_month[$i-1]["charges"] += $shipment->shipment_price;
                        $shipments_per_year[$year] = $shipments_per_month;
                    }
                }
            }
        }
        //dd($selected_year);
        
        return view('shippers.view_shipper', compact('shipper','shipments_per_year','min_year','max_year','selected_year'));
    }

    public function update(Shipper $shipper) {
        $data = request()->validate([
            'name' => 'required|min:4',
            'email' => 'nullable',
            'phone' => 'nullable',
            'website' => 'nullable'
        ]);

        $shipper->update($data);
        
        return redirect('shippers')->with('message', 'Επιτυχής επεξεργασία Μεταφορικής!');
    }

    public function destroy(Shipper $shipper) {
        $shipper->delete();

        return redirect('shippers')->with('message', 'Επιτυχής διαγραφή Μεταφορικής!');
    }

    public function getNames(){
        $names = Shipper::pluck('name')->toArray();

        return $names;
    }
}