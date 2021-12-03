<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;



class EmployeeController extends Controller {
    
    // Show all records of employees table
    public function index() {
        $employees = \App\Models\Employee::all();
        return view('employees.employees', compact('employees'));
    }

    public function add_employee() {
        return view ('employees.add_employee');
    }

    public function store() {

        $data = request()->validate([
            'surname' => 'required',
            'first_name' => 'required',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',
            'date_of_birth' => 'nullable',
            'mobile' => 'nullable',
            'phone2' => 'nullable',
            'date_joined' => 'nullable',
            'date_left' => 'nullable',
            'amka' => 'nullable',
            'ama' => 'nullable',
            'afm' => 'nullable|digits:9',
            'adt' => 'nullable',
            'citinzenship' => 'nullable',
            'contract_type' => 'nullable',
            'contract_expiring' => 'nullable',
            'working_days' => 'nullable',
            'working_hours' => 'nullable',
            'speciality' => 'nullable',
            'marital_status' => 'nullable',
            'children' => 'nullable',
            'leave_days_entitled' => 'nullable',
            'leave_days_taken' => 'nullable',
            'notes' => 'nullable'
        ]);

        //dd($data);

        \App\Models\Employee::create($data);

        return redirect('employees')->with('message', 'Επιτυχής αποθήκευση Εργαζόμενου!');
    }

    public function show($employeeId) {
        $employee = \App\Models\Employee::findOrFail($employeeId);
        //dd($employee);
        return view('employees.edit_employee', compact('employee'));
    }

    public function update(\App\Models\Employee $employee) {
      
        $data = request()->validate([
            'surname' => 'required',
            'first_name' => 'required',
            'father_name' => 'nullable',
            'mother_name' => 'nullable',
            'date_of_birth' => 'nullable',
            'mobile' => 'nullable',
            'phone2' => 'nullable',
            'date_joined' => 'nullable',
            'date_left' => 'nullable',
            'amka' => 'nullable',
            'ama' => 'nullable',
            'afm' => 'nullable|digits:9',
            'adt' => 'nullable',
            'citinzenship' => 'nullable',
            'contract_type' => 'nullable',
            'contract_expiring' => 'nullable',
            'working_days' => 'nullable',
            'working_hours' => 'nullable',
            'speciality' => 'nullable',
            'marital_status' => 'nullable',
            'children' => 'nullable',
            'leave_days_entitled' => 'nullable',
            'leave_days_taken' => 'nullable',
            'notes' => 'nullable'
        ]);

        $employee->update($data);
          
        return redirect('employees')->with('message', 'Επιτυχής επεξεργασία Εργαζόμενου!');
        
    }

    public function destroy(\App\Models\Employee $employee) {
        $employee->delete();

        return redirect('employees')->with('message', 'Ο εργαζόμενος έχει διαγραφεί!');
    }
}
