<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Show all records of orders table
    public function index()
    {
        $orders = \App\Models\Order::all();
        return view('orders.orders', compact('orders'));
    }

    public function store()
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

        \App\Models\Order::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση Μεταφορικής!');
    }

    public function show($orderId)
    {
        $order = \App\Models\Order::findOrFail($orderId);
        //dd($order);
        return view('orders.edit_order', compact('order'));
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

        return redirect('orders');
    }
}
