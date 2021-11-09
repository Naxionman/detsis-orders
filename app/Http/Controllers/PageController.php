<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('welcome');       
    }
    
    public function suppliers(){
        return view('suppliers');       
    }

    public function employees(){
        return view('employees');       
    }
    
    public function shippers(){
        return view('shippers');       
    }
    
    public function vehicles(){
        return view('vehicles');       
    }
    
    public function add_supplier(){
        return view ('suppliers.add_supplier');
    }
    
    public function add_employee(){
        return view ('employees.add_employee');
    }
    public function add_shipper(){
        return view ('shippers.add_shipper');
    }
    
    public function add_vehicle(){
        return view ('vehicles.add_vehicle');
    }
}
