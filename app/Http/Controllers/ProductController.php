<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\Price;

class ProductController extends Controller {
    
    // Show all records of products table
    public function index() {
        $suppliers = Supplier::all();
        $products = Product::all();
    
        return view('products.products', compact('products','suppliers'));
    }

    public function addProduct() {
        $suppliers = Supplier::all();
        $products = Product::all();

        $codes = Product::pluck('detsis_code')->toArray();
        
        return view ('products.add_product', compact('suppliers','products','codes'));
    }

    public function store() {
        $data = request()->validate([
            'detsis_code' => 'required|unique:products,detsis_code',
            'product_code' => 'required|unique:products,product_code',
            'product_name'=>'required|unique:products,product_name',
            'stock_level' => 'nullable',
            'min_level' => 'nullable',
            'image_url' => 'nullable',
            'notes' => 'nullable'
        ]);

        Product::create($data);
        
        return redirect()->back()->with('message', 'Επιτυχής αποθήκευση προϊόντος!');
    }

    public function show($productId) {
        $product = Product::findOrFail($productId);
        
        return view('products.edit_product', compact('product'));
    }

    public function showDetails($productId) {
        $product = Product::findOrFail($productId);
        $last_product = Product::all()->last();
        
        $prices = Price::where('product_id','=',$productId)->get();
        
        return view('products.view_product', compact('product','last_product','prices'));
    }

    public function update(Product $product) {
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
            $source = 'C:\Users\Detsis Factory Nick\Desktop\Εικόνες\Για το πρόγραμμά μας\P R O D U C T S\\'.request()->input('image_url');
            $target = 'images/products/'.request()->input('image_url');
            copy($source, $target);
        }

        $product->update($data);
       
        return redirect('products')->with('message', 'Επιτυχής επεξεργασία προϊόντος!');
    }

    public function destroy(Product $product) {
        $product->delete();

        return redirect('products')->with('message', 'Επιτυχής διαγραφή προϊόντος!');
    }
}