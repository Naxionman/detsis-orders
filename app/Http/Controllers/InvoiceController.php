<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index() {
        $invoices = \App\Models\Invoice::all();

        return view('invoices.invoices', compact('invoices'));
    }

    
    public function add_invoice($orderId) {
        $suppliers = \App\Models\Supplier::all();
        $shippers = \App\Models\Shipper::all();
        $products = \App\Models\Product::all();
        $shipments = \App\Models\Shipment::all();
        $orders = \App\Models\Order::where('pending','=',1);
        $order = \App\Models\Order::findOrFail($orderId);
        $details = \App\Models\OrderDetails::where('order_id', $orderId)->get();
        return view ('invoices.add_invoice', compact('suppliers','products','shipments','shippers', 'orders','order', 'details'));
    }


    public function store(Request $request) {  
        $count = $request->input('count');

        $order = Order::findOrFail($request->input('order_id'));

        if($request->input('shared_invoice') !=null) {

        } else{
            //First we create and store the shipment
            $shipment = \App\Models\Shipment::create([
                'shipping_date' => $request->input('arrival_date'),
                'shipper_id' => $request->input('shipper_id'),
                'shipment_price' => $request->input('shipment_price'),
                'extra_shipper_id' => $request->input('extra_shipper_id'),
                'invoice_number' => $request->input('shipping_invoice_number'),
                'extra_price' => $request->input('extra_price'),
            ]);
        }


        //Order update
        $data_for_orders = [
            'arrival_date' => $request->input('arrival_date'),
        ];
        
        $order->update($data_for_orders);
        
        

        //Next we update the details
        for ($i=0; $i < $count+1; $i++) { 
            
        }

        //We finally validate, create and store the invoice
        $data = request()->validate([
            'arrival_date' => 'required',
            'invoice_date' => 'required',
            'supplier_id' => 'required',
            'shipment_id' => 'required',
            'invoice_number' => 'required',
            'invoice_tax_rate' => 'nullable',
            'invoice_total' => 'required',
            'extra_charges' => 'nullable',
            'invoice_discount' => 'nullable',
            'notes' => 'nullable',
        ]);

        Invoice::create([
            'invoice_date' => $request->input('invoice_date'),
            'invoice_number' => $request->input('order_invoice_number'),
            'shipment_id' => $shipment->id,
        ]);

        return redirect('/orders')->with('message', 'Επιτυχής αποθήκευση Τιμολογίου!');
        
    }

   
}
