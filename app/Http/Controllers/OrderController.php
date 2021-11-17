<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

    public function store(Request $request)
    {
        $data = request()->validate([
            'order_date' => 'required',
            'supplier_id' => 'required',
            'shipper_id' => 'nullable',
            'order_discount' => 'nullable',
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
        
        $sum = 0;
        foreach ($order_details as $detail) {
            $sum = $detail->price + $sum;
        }


        return view('orders.view_order', compact('order','order_details', 'sum'));
    }


    public function update(\App\Models\Order $order)
    {
        //dd($order);

        $data = request()->validate([
            'order_date' => 'required',
            'supplier_id' => 'required',
            'shipper_id' => 'nullable',
            'order_discount' => 'nullable',
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

    public function destroy(\App\Models\Order $order) 
    {
        $order->delete();

        return redirect('/orders');
    }
}
