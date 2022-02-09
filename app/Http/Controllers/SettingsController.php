<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Constants;

class SettingsController extends Controller {
    
    public function index(){

        $constants = Constants::all();

        return view('settings.constants',compact('constants'));
    }
}
