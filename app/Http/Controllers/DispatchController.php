<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DispatchController extends Controller
{
    // Show all records of dispatches table
    public function index()
    {
        $dispatches = \App\Models\Dispatch::all();
        return view('dispatches.dispatches', compact('dispatches'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|unique:dispatches|min:4'
            
        ]);

        \App\Models\Dispatch::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση κίνησης!');
    }

    public function show($dispatchId)
    {
        $dispatch = \App\Models\Dispatch::findOrFail($dispatchId);
        //dd($dispatch);
        return view('dispatches.edit_dispatch', compact('dispatch'));
    }

    public function update(\App\Models\Dispatch $dispatch)
    {
        //dd($dispatch);

        $data = request()->validate([
            'name' => 'required|min:4',
            
        ]);

        $dispatch->update($data);
        //dd($dispatch->name);
        
        $dispatchs = \App\Models\Dispatch::all();
        return view('dispatches', compact('dispatches'));
    }

    public function destroy(\App\Models\Dispatch $dispatch)
    {
        $dispatch->delete();

        return redirect('dispatches');
    }
}
