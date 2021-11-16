<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::create([
            'detsis_code' => 'SHOWROOM',
            'product_code'=> 'SHOWROOM',
            'product_name'=> 'Παραγγελία από Έκθεση',
            'notes' => 'Κωδικός για να μπορούμε να καταγράφουμε τα ποσά και τις μεταφορικές'
        ]);
    }
}
