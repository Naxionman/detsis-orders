<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Show all records of orders table
    public function index()
    {
        $orders = \App\Models\Order::all();
        return view('orders.orders', compact('orders'));
    }

    public function add_order(){

        $suppliers = \App\Models\Supplier::all();
        $products = \App\Models\Product::all();
        $shippers = \App\Models\Shipper::all();

        return view ('orders.add_order', compact('suppliers','products','shippers'));
    }

    //New order. We need to distinguish if it is about the Showroom or the factory.
    public function store(Request $request) 
    {
        $data = request()->validate([
            'order_date' => 'required',
            'supplier_id' => 'required',
            'shipper_id' => 'nullable',
            'order_discount' => 'nullable',
            'order_charges' => 'nullable',
            'order_price' => 'nullable',
            'pending' => 'required',
            'notes' => 'nullable',
            'arrival_date' => 'nullable'
        ]);

        $new_order = \App\Models\Order::create($data);

        $details = request()->all();
        
        $products_count = request()->input('count');
        
        for ($i=0; $i < $products_count +1 ; $i++){
            
            $product_to_add = Product::find($request->input('product'.$i));
     
            \App\Models\OrderDetails::create([
                'order_id' => $new_order->id,
                'quantity' => $request->input('quantity'.$i),
                'product_id' => $product_to_add->id,
            ]);
        }
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση παραγγελίας!');
    }

    public function show($orderId)
    {
        $order = \App\Models\Order::findOrFail($orderId);
        $shippers = \App\Models\Shipper::all();
        $order_details = \App\Models\OrderDetails::where('order_id', $orderId)->get();
        //dd($models);

        return view('orders.edit_order', compact('order','order_details', 'shippers'));
    }

    public function showDetails($orderId)
    {
        $order = \App\Models\Order::findOrFail($orderId);

        $order_details = \App\Models\OrderDetails::where('order_id', $orderId)->get();
        
        return view('orders.view_order', compact('order','order_details'));
    }


    public function update(\App\Models\Order $order)
    {
        //dd($order);

        $data = request()->validate([
            'order_date' => 'required',
            'supplier_id' => 'required',
            'shipper_id' => 'nullable',
            'order_discount' => 'nullable',
            'order_charges' => 'nullable',
            'order_price' => 'nullable',
            'pending' => 'required',
            'notes' => 'nullable',
            'arrival_date' => 'nullable'
        ]);

        $order->update($data);
        //dd($order->name);
        
        $orders = \App\Models\Order::all();
        return view('orders', compact('orders'));
    }

    /*
     * This function update both Order and OrderDetails models respectively
     * It should be triggered when an actual order has been shipped and arrived.
     * 
    */

    public function updateDetails(Request $request){

        /*  This function modifies the following tables
         *      - Orders : Because it adds information of arrival date, prices and shipments  
         *      - Shipments : When an order arrives we know the shipment price and the invoice number
         *      - OrderDetails : The discounts, net values and tax_rate as well as the supplier's invoice number
         *      - Prices : We create new records for the ordered goods prices
         */

        //$data = request()->all();   //For debugging
        //dd($data);

        $count = $request->input('count');

        // Creating the history of prices of each product in the order [prices]
        for ($i=1; $i < $count+1 ; $i++) { 
            \App\Models\Price::create([
                'price_date' => $request->input('arrival_date'),
                'history_price' => $request->input('net_value'.$i),
                'history_discount' => $request->input('product_discount'.$i),
                'history_tax_rate' => $request->input('tax_rate'.$i),
                'product_id' => $request->input('product_id'.$i),
                'supplier_id' => $request->input('supplier_id'),
            ]);
        }

        // Updating OrderDetails  [order_details]      
        for ($i=1; $i < $count+1 ; $i++) { 
            $order_detail = OrderDetails::find($request->input('detail_id'.$i));

            $details_data = [
                'quantity' => $request->input('quantity'.$i),
                'measurement_unit' => $request->input('measurement_unit'.$i),
                'items_per_package' => $request->input('items_per_package'.$i),
                'product_discount' => $request->input('product_discount'.$i),
                'net_value' => $request->input('net_value'.$i),
                'tax_rate' => $request->input('tax_rate'.$i),
                'price' => $request->input('price'.$i),
            ];
            $order_detail->update($details_data);
        }
        
        //Create Shipment [shipments]
        $shipment = \App\Models\Shipment::create([
            'shipping_date' => $request->input('arrival_date'),
            'order_id' => $request->input('order_id'),
            'shipper_id' => $request->input('shipper_id'),
            'shipment_price' => $request->input('shipment_price'),
            'extra_shipper_id' => $request->input('extra_shipper_id'),
            'invoice_number' => $request->input('invoice_number'),
            'extra_price' => $request->input('extra_price'),
        ]);
        
        //Update Order [orders] with the newly created shipment!
        $order_id = $request->input('order_id');
        
        $shipment_id = $shipment->id;
        //dd($shipment_id);
        $order = \App\Models\Order::findOrFail($order_id);
        
        $order_data = [
            'arrival_date' => $request->input('arrival_date'),
            'shipment_id' => $shipment_id,
            'order_invoice_number' => $request->input('order_invoice_number'),
            'order_discount' => $request->input('order_discount'),
            'order_charges' => $request->input('order_charges'),
            'tax_rate' => $request->input('order_tax_rate'),
            'order_price' => $request->input('order_price'),
            'pending' => $request->input('pending'),
            'notes' => $request->input('notes')
        ];
               
        $order->update($order_data);
        
        return redirect('/orders');
    }
    
    public function destroy(\App\Models\Order $order) 
    {
        $order->delete();

        return redirect('/orders');
    }
}
