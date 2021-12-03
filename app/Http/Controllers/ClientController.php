<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller {

    // Show all records of client table
    public function index() {
        $clients = \App\Models\Client::all();
        return view('clients.clients', compact('clients'));
    }

    public function add_client() {
        return view ('clients.add_client');
    }
    public function store() {
        $data = request()->validate([
            'surname' => 'required',
            'name' => 'required',
            'email' => 'nullable',
            'mobile' => 'nullable',
            'phone2' => 'nullable',
            'address' => 'nullable',
            'notes' => 'nullable'
        ]);

        \App\Models\Client::create($data);

        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση Πελάτη!');
    }

    public function show($clientId) {
        $client = \App\Models\Client::findOrFail($clientId);
        
        return view('clients.edit_client', compact('client'));
    }

    public function update(\App\Models\Client $client) {
      
        $data = request()->validate([
            'surname' => 'required',
            'name' => 'required',
            'email' => 'nullable',
            'mobile' => 'nullable',
            'phone2' => 'nullable',
            'address' => 'nullable',
            'notes' => 'nullable'
        ]);

        $client->update($data);
                
        return redirect('client')->with('message', 'Τα στοιχεία του πελάτη επεξεργάσθηκαν με επιτυχία!');
    }
    
    public function destroy(\App\Models\Client $client) {
        $client->delete();

        return redirect('clients')->with('message', 'Επιτυχής διαγραφή Πελάτη!');
    }
}
