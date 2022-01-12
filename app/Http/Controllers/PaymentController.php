<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Supplier;

class PaymentController extends Controller {
    
    public function index() {
        $payments = Payment::all();

        return view('payments.payments', compact('payments'));
    }

    public function addPayment() {
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

        Payment::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση πληρωμής!');
    }
}