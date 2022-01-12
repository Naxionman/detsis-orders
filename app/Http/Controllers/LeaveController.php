<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Employee;
use Illuminate\Http\Request;

class LeaveController extends Controller {
    
    public function index() {
        $leaves = Leave::all();
        $employees = Employee::all(); 

        return view('employees.leaves.leaves', compact('leaves'));
    }

    public function addLeave($leaveId) {
        $vehicle = Leave::findOrFail($leaveId);
        
        return view ('employees.leaves.add_leave', compact('leave'));
    }
    
    public function store() {
        $data = request()->validate([
            'employee_id' => 'required',
            '' => 'required',
            '' => 'required',
            '' => 'required'
        ]);
        
        //dd($data);
        Leave::create($data);
        
        return redirect('employees.leaves.leaves')->with('message', 'Επιτυχής προσθήκη άδειας!');
    }

    public function destroy(Leave $leave) {
        $leave->delete();

        return redirect('leaves')->with('message', 'Επιτυχής διαγραφή άδειας!');
    }
}