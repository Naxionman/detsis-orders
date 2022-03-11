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
            'employee_id' => 'required',
            'salary_date' => 'required',
            'salary_month' => 'required',
            'salary_year' => 'required',
            'daily_wages' => 'nullable',
            'total_wages' => 'nullable',
            'basic_salary' => 'nullable',
            'total_salary' => 'nullable',
            'three_year_benefit' => 'nullable',
            'marriage_benefit' => 'nullable',
            'insurance_deduction_daily' => 'required',
            'agreed_daily_wages_sum' => 'nullable',
            'hourly_wage' => 'nullable',
            'gross_earnings' => 'nullable',
            'insurance_deduction_monthly'=>'required',
            'insurance_deduction_type'=>'required',
            'payroll_tax_deduction' => 'nullable',
            'advance' => 'nullable',
            'net_salary' => 'required'

        ]);
        //dd($data);
        Salary::create($data);

        return redirect('salaries')->with('message', 'Επιτυχής αποθήκευση Μισθοδοσίας!');
    }
}
