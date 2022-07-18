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

        //I think by doing this we find the files...Otherwise it's 404
        $removeMe = "public/order_files";
        $new_path = str_replace($removeMe,"", $path);

        OrderFile::create([
            'name' => $name,
            'path' => $new_path,
            'order_id' => $request->input('order_id') ,
        ]);

        return redirect()->back()->with('status', 'File Has been uploaded successfully in laravel');
    }

    public function destroy(OrderFile $file){
        $file->delete();

        return redirect()->back()->with('message', 'Επιτυχής διαγραφή αρχείου!');
    }

    
}


