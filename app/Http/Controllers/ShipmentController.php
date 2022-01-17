<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Supplier;
use App\Models\Shipper;

class ShipmentController extends Controller {
    
    // Show all records of shippers table
    public function index() {
        $shipments = Shipment::all();

        return view('shipments.shipments', compact('shipments'));
    }

    public function addShipment() {
        $suppliers = Supplier::all();
        $shippers = Shipper::all();
        
        return view ('shippers.add_shipment', compact('suppliers','shippers'));
    }
}