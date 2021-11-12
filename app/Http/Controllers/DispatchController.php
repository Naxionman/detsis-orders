<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use App\Models\Employee;
use Illuminate\Http\Request;

class DispatchController extends Controller
{
    // Show all records of dispatches table
    public function index()
    {
        
        $dispatches = \App\Models\Dispatch::all();
        return view('dispatches.dispatches', compact('dispatches'));
    }

    public function add_dispatch(){
        $vehicles = \App\Models\Vehicle::all();
        $employees = \App\Models\Employee::all();

        return view ('dispatches.add_dispatch', compact('vehicles','employees'));
    }

    public function store(Request $request)
    {
        $number_of_employees = $request->input('count');

        //Creating a new dispatch without employees...
        $dispatch = Dispatch::create([
                'dispatch_date' => $request->input('dispatch_date'),
                'vehicle_id'    => $request->input('vehicle_id'),
                'client'        => $request->input('client'),
                'notes'        => $request->input('notes'),
            ]);
        
        for ($i=0; $i < $number_of_employees+1 ; $i++) { 
            
            $employeeDispatched = Employee::find($request->input('employee'.$i));
            $dispatch->employees()->attach($employeeDispatched); 
        }

        //\App\Models\Dispatch::create($data);
        
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
