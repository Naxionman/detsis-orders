<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Shipper;
use App\Models\Shipment;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class InvoiceController extends Controller {
    
    public function index() {
        $invoices = \App\Models\Invoice::all();

        return view('invoices.invoices', compact('invoices'));
    }
    
    public function add_invoice($orderId) {
        $suppliers = Supplier::all();
        $shippers = Shipper::all();
        $products = Product::all();
        $shipments = Shipment::all();
        $orders = Order::where('pending','=',1)->get();
        $order = Order::findOrFail($orderId);
        $details = OrderDetails::where('order_id', $orderId)->get();

        return view ('invoices.add_invoice', compact('suppliers','products','shipments','shippers', 'orders','order', 'details'));
    }

    public function store(Request $request) { 
        //The counter of the products 
        $count = $request->input('count');
        //dd($request);
        //The order through which we create a new invoice
        $order = Order::findOrFail($request->input('order_id'));
        
        //dd($request);
        //dd($request->input('shared_shipment'));

        //There maybe more than one invoices with the same shipment. In this case we don't create a shipment as there is already one.
        if($request->input('shared_shipment') != 'null') {
            $shared_shipment_id = $request->input('shared_shipment');
            $shared_shipment = Shipment::find($shared_shipment_id);
            $shared_shipment->invoices()->attach($shared_shipment_id);
        } else {
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
            'notes' => $request->input('notes'),
            'pending' => 0
        ];
        $order->update($data_for_orders);
        
        //Next we update the details
        for ($i=1; $i < $count+1; $i++) { 
            
        }
        
        //We finally create and store the invoice
        $invoice = Invoice::create([
            'shipment_id' => $shipment->id,
            'supplier_id' => $order->supplier->id,
            'invoice_date' => $request->input('invoice_date'),
            'invoice_number' => $request->input('order_invoice_number'),
            'invoice_total' => $request->input('invoice_total'),
            'notes' => $request->input('notes')
        ]);
        
        //This invoice may refer to more than the order that brought us here
        $more_orders = $request->input('more_orders');
        $invoice->orders()->attach($more_orders);

        return redirect('/orders')->with('message', 'Επιτυχής αποθήκευση Τιμολογίου!');
    }
}