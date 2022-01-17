<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Supplier;
use App\Models\Payment;
use App\Models\Order;

class SupplierController extends Controller {
    
    // Show all records of suppliers table
    public function index() {
        $suppliers = Supplier::all();

        $orders = Order::where('pending', '=', '1');
        $invoices = Invoice::all();
        $payments = Payment::all();

        return view('suppliers.suppliers', compact('suppliers', 'orders','payments', 'invoices'));
    }

    public function addSupplier() {
        return view ('suppliers.add_supplier');
    }
    
    public function store() {
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
            'description' => 'nullable',
            'iban1' => 'nullable',
            'iban2' => 'nullable',
            'iban3' => 'nullable',
            'iban4' => 'nullable',
        ]);

        Supplier::create($data);
        
        return redirect('/')->with('message', 'Επιτυχής αποθήκευση Προμηθευτή!');
    }

    public function show($supplierId) {
        $supplier = \App\Models\Supplier::findOrFail($supplierId);
        //dd($supplier);

        return view('suppliers.edit_supplier', compact('supplier'));
    }

    public function showDetails($supplierId) {
        $supplier = Supplier::findOrFail($supplierId);
        
        //The number of invoices concerning this supplier
        $invoice_count = Invoice::where('supplier_id','=',$supplierId)->count();
        //The array of payments made to this supplier
        $paid = Payment::where('supplier_id','=',$supplierId)->sum('amount');
        //dd($paid);   
        $sum_charged = Invoice::where('supplier_id','=',$supplierId)->sum('invoice_total');        
        //The balance = invoice charges - payments + initial balance 
        $new_balance = $sum_charged - $paid + $supplier->balance;
        //dd($supplier->balance);

        return view ('suppliers.view_supplier', compact('supplier','invoice_count', 'sum_charged','paid','new_balance'));
    }

    public function update(Supplier $supplier) {
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
            'iban1'=>'nullable',
            'iban2'=>'nullable',
            'iban3'=>'nullable',
            'iban4'=>'nullable',
            'description' => 'nullable'
        ]);

        $supplier->update($data);
        
        return redirect('suppliers')->with('message', 'Επιτυχής επεξεργασία Προμηθευτή!');
    }

    public function destroy(Supplier $supplier) {
        $supplier->delete();

        return redirect('/suppliers')->with('message', 'Επιτυχής διαγραφή Προμηθευτή!');
    }
}