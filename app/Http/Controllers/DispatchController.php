<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use App\Models\Employee;
use App\Models\Vehicle;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DispatchController extends Controller {
    
    // Show all records of dispatches table
    public function index() {
        $dispatches = Dispatch::all();
    
        return view('dispatches.dispatches', compact('dispatches'));
    }

    public function log() {
        //Filtering out employees that are not going to be dispatched
        $employees = Employee::where('speciality', '!=', 'Υπάλληλος')
                                            ->where('date_left','=',null)
                                            ->where('surname','!=', 'Ψαρράς')
                                            ->get();
        $vehicles = Vehicle::all();

        return view('dispatches.dispatch_log', compact('vehicles','employees'));
    }

    public function addDispatch() {
        $vehicles = Vehicle::all();
        //$employees = Employee::all();
        $employees = Employee::where('speciality', '!=', 'Υπάλληλος')
                                ->where('date_left','=',null)
                                ->where('surname','!=', 'Ψαρράς')
                                ->get();

        $clients = Client::all();

        return view ('dispatches.add_dispatch', compact('vehicles','employees','clients'))->with('message', 'Επιτυχής προσθήκη κίνησης!');
    }

    public function store(Request $request) {
        $number_of_employees = $request->input('count');
        
        //Creating a new dispatch without employees...
        $dispatch = Dispatch::create([
                'dispatch_date' => $request->input('dispatch_date'),
                'vehicle_id'    => $request->input('vehicle_id'),
                'client_id'     => $request->input('client_id'),
                'address'       => $request->input('address'),
                'notes'         => $request->input('notes'),
            ]);
        
        for ($i=0; $i < $number_of_employees+1 ; $i++) { 
            $employeeDispatched = Employee::find($request->input('employee'.$i));
            $dispatch->employees()->attach($employeeDispatched); 
        }

        //\App\Models\Dispatch::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση κίνησης!');
    }

    public function show($dispatchId) {
        $dispatch = Dispatch::findOrFail($dispatchId);
        $vehicles = Vehicle::all();

        //Filter out those who aren't going to the dispatches
        $employees = Employee::where('speciality', '!=', 'Υπάλληλος')
                                            ->where('date_left','=',null)
                                            ->where('surname','!=', 'Ψαρράς')
                                            ->get();

        $dispatch_employees = DB::table('dispatch_employee')
                    ->where('dispatch_id','=',$dispatchId)
                    ->get();
        
        $clients = Client::all();
        //dd($dispatch);
        return view('dispatches.edit_dispatch', compact('dispatch','vehicles','employees','dispatch_employees','clients'));
    }

    public function update(Dispatch $dispatch, Request $request) {
        $data = request()->validate([
            'dispatch_date' => 'required',
            'vehicle_id'    => 'required',
            'client_id'     => 'required',
            'address'       => 'nullable',
            'notes'         => 'nullable'        
        ]);
       
        $dispatch->update($data);
        
        DB::table('dispatch_employee')
            ->where('dispatch_id','=',$request->input('dispatch_id'))
            ->delete();
        
        $number_of_employees = $request->input('count');
        for ($i=0; $i < $number_of_employees+1 ; $i++) { 
            $employeeDispatched = Employee::find($request->input('employee'.$i));
            $dispatch->employees()->attach($employeeDispatched);
        }

        return redirect('dispatches')->with('message', 'Επιτυχής επεξεργασία κίνησης!');
    }

    public function destroy(Dispatch $dispatch) {
        $dispatch->delete();

        return redirect('dispatches')->with('message', 'Επιτυχής διαγραφή κίνησης!');
    }
}