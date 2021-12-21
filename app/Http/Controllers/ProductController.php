<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all records of products table
    public function index() {
        $suppliers = \App\Models\Supplier::all();
        $products = \App\Models\Product::all();
        return view('products.products', compact('products','suppliers'));
    }

    public function add_product() {
        $suppliers = \App\Models\Supplier::all();
        $products = \App\Models\Product::all();
        
        return view ('products.add_product', compact('suppliers','products'));
    }

    public function store() {
        $data = request()->validate([
            'detsis_code' => 'required',
            'product_code' => 'required',
            'product_name'=>'required',
            'stock_level' => 'nullable',
            'min_level' => 'nullable',
            'image_url' => 'nullable',
            'notes' => 'nullable'
            
        ]);

        \App\Models\Product::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση προϊόντος!');
    }

    public function show($productId) {
        $product = \App\Models\Product::findOrFail($productId);
        
        return view('products.edit_product', compact('product'));
    }

    public function update(\App\Models\Product $product) {
        $data = request()->validate([
            'detsis_code' => 'required',
            'product_code' => 'required',
            'product_name'=>'required',
            'stock_level' => 'nullable',
            'min_level' => 'nullable',
            'last_supplier'=>'nullable',
            'image_url' => 'nullable',
            'notes' => 'nullable'
        ]);
        //dd(request()->input('image_url'));

        if(request()->input('image_url') != null){
            $source = 'C:\Users\Detsis Factory Nick\Desktop\Εικόνες για επεξεργασία\P R O D U C T S\/'.request()->input('image_url');
            $target = 'images/products/'.request()->input('image_url');
            copy($source, $target);
        }

        $product->update($data);
       
        return redirect('products')->with('message', 'Επιτυχής επεξεργασία προϊόντος!');
    }

    public function destroy(\App\Models\Product $product) {
        $product->delete();

        return redirect('products')->with('message', 'Επιτυχής διαγραφή προϊόντος!');
    }
}
