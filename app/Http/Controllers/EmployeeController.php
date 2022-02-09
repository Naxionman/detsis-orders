<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class EmployeeController extends Controller {
    
    // Show all records of employees table
    public function index() {
        $employees = Employee::all();

        return view('employees.employees', compact('employees'));
    }

    public function salaries() {
        $employees = Employee::all();

        $gross = array();
        //μικτές αποδοχές
        foreach($employees as $employee){
            if($employee->working_days == 6){
                $insurance_days = 26;
            } else {
                $insurance_days = 25;
            }
            if($employee->speciality == "Εργατοτεχνίτης"){
                $gross_earnings = $employee->salary * $insurance_days;
            } else {
                $gross_earnings = $employee->salary;
            }
            // Without any extras
            $gross[$employee->id] = $gross_earnings;

            //Extra: 

        }
        

        return view('employees.salaries.salaries', compact('employees','gross'));
    }

    public function addEmployee() {
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

        Employee::create($data);

        return redirect('employees')->with('message', 'Επιτυχής αποθήκευση Εργαζόμενου!');
    }

    public function show($employeeId) {
        $employee = Employee::findOrFail($employeeId);
        //dd($employee);

        return view('employees.edit_employee', compact('employee'));
    }

    public function update(Employee $employee) {
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

    public function destroy(Employee $employee) {
        $employee->delete();

        return redirect('employees')->with('message', 'Ο εργαζόμενος έχει διαγραφεί!');
    }
}