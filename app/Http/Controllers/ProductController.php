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
            'last_supplier'=>'nullable'
        ]);

        $product->update($data);
       
        return redirect('products');
    }

    public function destroy(\App\Models\Product $product) {
        $product->delete();

        return redirect('products');
    }
}
