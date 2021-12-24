<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'detsis_code' => 'SHOWROOM',
            'product_code'=> 'SHOWROOM',
            'product_name'=> 'Προϊόντα παραγγελίας από Έκθεση',
            'notes' => 'Κωδικός για να μπορούμε να καταγράφουμε τα ποσά και τις μεταφορικές'
        ]);

        Product::create([
            'detsis_code' => 'NoStock',
            'product_code'=> 'NoStock',
            'product_name'=> 'Προϊόντα μη αποθεματικής παραγγελίας εργοστασίου',
            'notes' => 'Κωδικός για να μπορούμε να καταγράφουμε τις μη αποθεματικές παραγγελίες του εργοστασίου'
        ]);

        Product::create([
            'detsis_code' => 'extra',
            'product_code'=> 'extra',
            'product_name'=> 'Άλλες χρεώσεις',
            'notes' => 'Κωδικός για να μπορούμε να καταγράφουμε τις επιπλέον χρεώσεις που τοποθετούνται ως προϊόντα'
        ]);

        Product::create([
            'detsis_code' => '001',
            'product_code'=> '001',
            'product_name'=> 'Δοκιμαστικό προϊόν 1',
            'notes' => 'Προϊόν που έχει δημιουργηθεί για δοκιμές στη βάση'
        ]);
        
        Product::create([
            'detsis_code' => '002',
            'product_code'=> '002',
            'product_name'=> 'Δοκιμαστικό προϊόν 2',
            'notes' => 'Προϊόν που έχει δημιουργηθεί για δοκιμές στη βάση'
        ]);
        
        Product::create([
            'detsis_code' => '003',
            'product_code'=> '003',
            'product_name'=> 'Δοκιμαστικό προϊόν 3',
            'notes' => 'Προϊόν που έχει δημιουργηθεί για δοκιμές στη βάση'
        ]);
        
        Product::create([
            'detsis_code' => '004',
            'product_code'=> '004',
            'product_name'=> 'Δοκιμαστικό προϊόν 4',
            'notes' => 'Προϊόν που έχει δημιουργηθεί για δοκιμές στη βάση'
        ]);
        
    }
}
