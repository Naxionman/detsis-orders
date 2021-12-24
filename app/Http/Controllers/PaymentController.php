<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PaymentController extends Controller {
    
    public function index() {
        $payments = Payment::all();

        return view('payments.payments', compact('payments'));
    }

    public function add_payment() {
        $suppliers = Supplier::all();

        return view ('payments.add_payment', compact('suppliers'));
    }

    public function store() {
        
        $data = request()->validate([
            'supplier_id' => 'required',
            'payment_date' => 'required',
            'bank' => 'required',
            'holder'=> 'nullable',
            'amount' => 'required',
        ]);

        \App\Models\Payment::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση πληρωμής!');
    }
    
}
