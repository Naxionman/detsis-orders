<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Show all records of suppliers table
    public function index()
    {
        $suppliers = \App\Models\Supplier::all();
        return view('suppliers.suppliers', compact('suppliers'));
    }

    public function add_supplier(){
        return view ('suppliers.add_supplier');
    }
    
    public function store()
    {
        $data = request()->validate([
            'company_name' => 'required|unique:suppliers|min:4',
            'salesman' => 'nullable',
            'email'=> 'nullable',
            'phone1' => 'nullable',
            'phone2' => 'nullable',
            'website' => 'nullable',
            'afm' => 'nullable|digits:9',
            'address' => 'nullable',
            'zipcode' => 'nullable|digits:5',
            'city' => 'nullable',
            'description' => 'nullable'
        ]);

        \App\Models\Supplier::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση Προμηθευτή!');
    }

    public function show($supplierId)
    {
        $supplier = \App\Models\Supplier::findOrFail($supplierId);
        //dd($supplier);
        return view('suppliers.edit_supplier', compact('supplier'));
    }

    public function update(\App\Models\Supplier $supplier)
    {
       
        //dd($supplier);

        $data = request()->validate([
            'company_name' => 'required|min:4',
            'salesman' => 'nullable',
            'email' => 'nullable',
            'phone1' => 'nullable',
            'phone2' => 'nullable',
            'website' => 'nullable',
            'afm' => 'nullable|digits:9',
            'address' => 'nullable',
            'zipcode' => 'nullable|digits:5',
            'city' => 'nullable',
            'description' => 'nullable'
        ]);

        $supplier->update($data);
        //dd($supplier->company_name);
        
        $suppliers = \App\Models\Supplier::all();
        
        return redirect('/suppliers');
    }

    public function destroy(\App\Models\Supplier $supplier)
    {
        $supplier->delete();

        return redirect('/suppliers');
    }
}
