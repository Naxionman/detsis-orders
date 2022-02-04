<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderFileController extends Controller {
    
    public function addFile() {
        $data = request()->validate([
            'order_id' => 'required',
            'filename' => 'required',
            
        ]);

        return redirect()->back();
    }
}
