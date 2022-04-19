<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller {

    // Show all records of client table
    public function index() {
        $clients = Client::all();
        return view('clients.clients', compact('clients'));
    }

    public function addClient() {
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

        Client::create($data);
        
        return redirect('/')->with('message', 'Επιτυχής αποθήκευση Πελάτη!');
    }

    public function show($clientId) {
        $client = Client::findOrFail($clientId);
        
        return view('clients.edit_client', compact('client'));
    }

    public function update(Client $client) {
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
                
        return redirect('clients')->with('message', 'Τα στοιχεία του πελάτη επεξεργάσθηκαν με επιτυχία!');
    }
    
    public function destroy(Client $client) {
        $client->delete();

        return redirect('clients')->with('message', 'Επιτυχής διαγραφή Πελάτη!');
    }
}
