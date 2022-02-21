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

        $dionysos_shipments = Shipment::where('shipper_id',2)->get();
        $last_month_sum = 0;
        $current_month_sum = 0;
        $current_month = date('m');
        if($current_month = 1){
            $last_month = 12;
        }else{
            $last_month = $current_month - 1;
        }

        //Calculating sums of current and previous month for DIONYSOS (id : 2)
        foreach($dionysos_shipments as $dionysos_shipment){
            if($dionysos_shipment->shipping_date->month == $current_month) {
                $current_month_sum += $dionysos_shipment->shipment_price;
            }
            
            if($dionysos_shipment->shipping_date->month == $last_month) {
                $last_month_sum += $dionysos_shipment->shipment_price;
            }
        }
        return view('shipments.shipments', compact('shipments','current_month_sum','last_month_sum'));
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

    public function show($shipmentId) {
        $shipment = Shipment::findOrFail($shipmentId);
        $suppliers = Supplier::all();
        $shippers = Shipper::all();
        $invoices = Invoice::all();        
        $supplier_invoices = Invoice::where('shipment_id',$shipmentId)->get();

        return view('shipments.edit_shipment', compact('shipment','suppliers','supplier_invoices','shippers','invoices'));
    }

    public function showDetails($shipmentId){

        $shipment = Shipment::findOrFail($shipmentId);

        $supplier_invoices_count = Invoice::where('shipment_id',$shipmentId)->count();
        $supplier_invoices = Invoice::where('shipment_id',$shipmentId)->get();

        return view('shipments.view_shipment', compact('supplier_invoices','supplier_invoices_count','shipment'));
    }

    public function update(Shipment $shipment){
        
        $data = request()->validate([
            'shipper_id' => 'required',
            'shipment_invoice_number' => 'nullable',
            'shipping_date' => 'required',
            'supplier_id' => 'required',
            'shipment_price' => 'nullable',
            'extra_shipper_id' => 'nullable',
            'extra_price' => 'nullable',
        ]);

        $shipment->update($data);

        //Relating invoice(s) to this shipment
        $boundInvoices = $_POST['invoices']; //We get the array from the post request
        //We iterate through the array
        //dd($boundInvoices);
        foreach($boundInvoices as $id){
            //dd($id);
            $invoice = Invoice::findorFail($id);
            //dd($invoice);
            $invoice->shipment_id = $shipment->id;
            $invoice->save();
        }

        return redirect('shipments')->with('message', 'Επιτυχής επεξεργασία φορτωτικής');
    }

    public function destroy(Shipment $shipment){
        $shipment->delete();

        return redirect('shipments')->with('message', 'Επιτυχής διαγραφή Τιμολογίου Μεταφορικής!');
    }

    public function getShipments($id) {
        $shipments = Shipment::where("supplier_id", $id)->get();
        //dd($shipments);
        return $shipments;
    }
}