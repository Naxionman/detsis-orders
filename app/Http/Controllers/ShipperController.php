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
}