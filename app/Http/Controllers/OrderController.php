<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipper;
use App\Models\Supplier;
use App\Models\Client;
use Illuminate\Http\Request;

class OrderController extends Controller {
    
    // Show all records of orders table
    public function index() {
        $orders =  Order::all();
        $orders_count = $orders->count();
        $orders_pending = Order::where('pending', 1)->count();

        return view('orders.orders', compact('orders', 'orders_count','orders_pending'));
    }

    public function addOrder() {
        $suppliers = Supplier::all();
        $products = Product::all();
        $clients = Client::all();
        
        return view ('orders.add_order', compact('suppliers','products', 'clients'));
    }

    public function store(Request $request) {
        $new_order = Order::create ([
            'order_date'    => $request->input('order_date'),
            'order_type'    => '',
            'client_id'     => $request->input('client_id'),
            'supplier_id'   => $request->input('supplier_id'),
            'pending'       => $request->input('pending'),
            'notes'         => $request->input('notes'),
            'arrival_date'  => $request->input('arrival_date'),
        ]);

        //After creating an instance of Order we set the type
        $first_product = Product::find($request->input('product1'));

        if($first_product->id == 1) {
            $new_order->order_type = 'Εμπόριο';
        } elseif ($first_product->id == 2){
            $new_order->order_type = 'Εργοστάσιο (Μ)';
        } else {
            $new_order->order_type = 'Εργοστάσιο';
        }

        $new_order->save();
        
        $products_count = request()->input('count');
        
        for ($i=1; $i < $products_count +1 ; $i++){
            $product_to_add = Product::find($request->input('product'.$i));
        
            //No financial details of order_details are provided here
            OrderDetails::create([
                'order_id' => $new_order->id,
                'quantity' => $request->input('quantity'.$i),
                'product_id' => $product_to_add->id,
            ]);
        }
        
        return redirect('/orders')->with('message', 'Επιτυχής αποθήκευση παραγγελίας!');
    }

    public function show($orderId) {
        $order = Order::findOrFail($orderId);
        $shippers = Shipper::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        $clients = Client::all();
        $details = OrderDetails::where('order_id', $orderId)->get();
        
        return view('orders.edit_order', compact('order','details', 'shippers','suppliers','products','clients'));
    }

    public function showDetails($orderId) {
        $order = Order::findOrFail($orderId);

        $order_details = OrderDetails::where('order_id', $orderId)->get();
        
        return view('orders.view_order', compact('order','order_details'));
    }

    public function update(Order $order) {
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

        $details = OrderDetails::where('order_id',$order->id)->get();
        $i = 1;
        $product_id = request()->input('product'.$i);
        
        foreach ($details as $detail) {
            $detail->product_id = $product_id;
            $i++;
            $detail->save();
            if($product_id == 1){
                $order->order_type = "Εμπόριο";
                $order->save();
            } elseif($product_id == 2){
                $order->order_type = "Εργοστάσιο (Μ)";
                $order->save();
            } else {
                $order->order_type = "Εργοστάσιο";
                $order->save();
            }
        }
        
        return redirect('/orders')->with('message', 'Επιτυχής επεξεργασία παραγγελίας!');
    }

    public function destroy(Order $order) {
        $order->delete();

        return redirect('/orders')->with('message', 'Επιτυχής διαγραφή παραγγελίας!');
    }
}