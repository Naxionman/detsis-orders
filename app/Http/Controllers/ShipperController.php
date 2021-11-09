<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipperController extends Controller
{
    // Show all records of shippers table
    public function index()
    {
        $shippers = \App\Models\Shipper::all();
        return view('shippers.shippers', compact('shippers'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|unique:shippers|min:4',
            'phone' => 'nullable',
            'email'=> 'nullable',
            'website' => 'nullable',
        ]);

        \App\Models\Shipper::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση Μεταφορικής!');
    }

    public function show($shipperId)
    {
        $shipper = \App\Models\Shipper::findOrFail($shipperId);
        //dd($shipper);
        return view('shippers.edit_shipper', compact('shipper'));
    }

    public function update(\App\Models\Shipper $shipper)
    {
        //dd($shipper);

        $data = request()->validate([
            'name' => 'required|min:4',
            'email' => 'nullable',
            'phone' => 'nullable',
            'website' => 'nullable'
        ]);

        $shipper->update($data);
        //dd($shipper->name);
        
        $shippers = \App\Models\Shipper::all();
        return view('shippers', compact('shippers'));
    }

    public function destroy(\App\Models\Shipper $shipper)
    {
        $shipper->delete();

        return redirect('shippers');
    }
}