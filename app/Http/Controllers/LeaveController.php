<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Employee;


class LeaveController extends Controller {
    
    public function index() {
        $leaves = Leave::all();
        $employees = Employee::all(); 

        return view('employees.leaves.leaves', compact('leaves','employees'));
    }

    public function addLeave() {
        $employees = Employee::all(); 

        return view ('employees.leaves.add_leave', compact('employees'));
    }
    
    public function store() {
        $data = request()->validate([
            'employee_id' => 'required',
            'start_date' => 'required',
            'last_date' => 'required',
        ]);

        Leave::create($data);

        //Now that the Leave model has been created we need to change the values of the Employee model
        $employee = Employee::findOrFail(request()->input('employee_id'));

        $days_taken = request()->input('days_taken');

        $employee->leave_days_taken = $days_taken;
        $employee->save();
        
        return redirect('leaves')->with('message', 'Επιτυχής προσθήκη άδειας!');
    }

    public function destroy(Leave $leave) {
        $leave->delete();

        return redirect('leaves')->with('message', 'Επιτυχής διαγραφή άδειας!');
    }

    public function getEmployeeLeaveDays($employeeId) {

        $days_entitled = Employee::where('id', $employeeId)->value('leave_days_entitled');
        $days_taken = Employee::where('id', $employeeId)->value('leave_days_taken');

        $days_remaining = $days_entitled - $days_taken;
        
        return $days_remaining;
        
    }
}