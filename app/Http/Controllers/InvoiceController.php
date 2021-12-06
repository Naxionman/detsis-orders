<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
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
        $orders = \App\Models\Order::where('pending','=',1);
        $order = \App\Models\Order::findOrFail($orderId);
        $details = \App\Models\OrderDetails::where('order_id', $orderId)->get();
        return view ('invoices.add_invoice', compact('suppliers','products','shippers', 'orders','order', 'details'));
    }


    public function create(Request $request) {  
        $count = $request->input('count');
        
        //First we create and store the shipment
        $shipment = \App\Models\Shipment::create([
            'shipping_date' => $request->input('arrival_date'),
            'invoice_id' => $request->input('order_id'),
            'shipper_id' => $request->input('shipper_id'),
            'shipment_price' => $request->input('shipment_price'),
            'extra_shipper_id' => $request->input('extra_shipper_id'),
            'invoice_number' => $request->input('invoice_number'),
            'extra_price' => $request->input('extra_price'),
        ]);

        //Next we update the details
        for ($i=0; $i < $count+1; $i++) { 
            
        }

        //We finally create and store the invoice

        $data = request()->validate([
            'arrival_date' => 'required',
            'supplier_id' => 'required',
            'shipment_id' => 'required',
            'invoice_number' => 'required',
            'invoice_tax_rate' => 'required',
            'invoice_total' => 'required',
            'extra_charges' => 'nullable',
            'invoice_discount' => 'nullable',
            'notes' => 'nullable',
        ]);

        Invoice::create([
            'arrival_date' => $request->input('arrival_date'),
            'invoice_number' => $request->input('invoice_number'),

        ]);


        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
