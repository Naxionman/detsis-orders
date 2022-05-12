<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderFile;
use Illuminate\Http\Request;

class OrderFileController extends Controller {
    
    public function index() {
        //???????????????
        return view('file-upload');
    }

    public function addFile(Request $request) {
        $data = $request->validate([
            'file' => 'required'
        ]);

        $name = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->store('public/order_files');

        $save = new OrderFile;

        $save->name = $name;
        $save->path = $path;

        OrderFile::create([
            'name' => $name,
            'path' => $path,
            'order_id' => $request->input('order_id') ,
        ]);

        return redirect()->back()->with('status', 'File Has been uploaded successfully in laravel');
 
    }
}


