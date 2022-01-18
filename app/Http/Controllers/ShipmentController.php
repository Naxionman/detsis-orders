<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Supplier;
use App\Models\Shipper;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderDetails;

class ShipmentController extends Controller {
    
    // Show all records of shippers table
    public function index() {
        $shipments = Shipment::all();

        return view('shipments.shipments', compact('shipments'));
    }

    public function addShipment() {
        $suppliers = Supplier::all();
        $shippers = Shipper::all();

        return view ('shipments.add_shipment', compact('suppliers','shippers'));
    }

    public function store() {
        $data = request()->validate([
            'shipping_date' => 'required',
            'shipper_id' => 'required',
            'supplier_id' => 'required',
            'extra_shipper_id'=> 'nullable',
            'shipment_invoice_number' => 'required',
            'shipment_price' => 'required',
            'extra_price' => 'nullable',
        ]);

        Shipment::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση Τιμολογίου Μεταφορικής!');
    }

    public function showDetails($shipmentId){

        $shipment = Shipment::findOrFail($shipmentId);

        $supplier_invoices = Invoice::where('shipment_id',$shipmentId)->get();

        
        
        //$orders = OrderDetails::where('shipment_id',$shipmentId)->get();

        return view('shipments.view_shipment', compact('supplier_invoices','orders'));
    }
}