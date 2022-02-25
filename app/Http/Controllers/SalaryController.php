<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller {
    
    public function addSalary() {
        $employees = Employee::all();

        return view('employees.salaries.add_salary', compact('employees'));
    }

    //Ajax call function
    public function getEmployee($id) {
        $selectedEmployee = Employee::findOrFail($id);

        return $selectedEmployee;
    }

    public function store(){
        $data = request()->validate([

        ]);
        
        Salary::create($data);

        return redirect('salaries')->with('message', 'Επιτυχής αποθήκευση Προμηθευτή!');
    }
}
