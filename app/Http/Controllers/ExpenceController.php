<?php

namespace App\Http\Controllers;

use App\Models\Expence;
use Illuminate\Http\Request;

class ExpenceController extends Controller {
    
    public function index() {
        $expences = Expence::all();

        return view('expences.expences', compact('expences'));
    }

    public function addExpence(){

        return view('expences.add_expence');
    }

    public function store() {
        $data = request()->validate([
            'expence_date' => 'required',
            'description' => 'required',
            'amount' => 'required'
        ]);

        Expence::create($data);
                
        return redirect('/expences')->with('message', 'Επιτυχής προσθήκη παγίου εξόδου!');
    }

    public function show($expenceId) {
        $expence = Expence::findOrFail($expenceId);
       
        return view('expences.edit_expence', compact('expence'));
    }

    public function update(Expence $expence) {
        $data = request()->validate([
            'expence_date' => 'required',
            'description' => 'required',
            'amount' => 'nullable',
        ]);

        $expence->update($data);
        
        return redirect('expences')->with('message', 'Επιτυχής επεξεργασία παγίου εξόδου!');
    }

    public function destroy(Expence $expence) {
        $expence->delete();

        return redirect('expences')->with('message', 'Επιτυχής διαγραφή παγίου εξόδου!');
    }
}
