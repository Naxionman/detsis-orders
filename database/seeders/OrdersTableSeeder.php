<?php

namespace Database\Seeders;



use App\Models\Order;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'order_date' => '21-11-2021',
            'order_type' => 'Εμπόριο',
            'supplier_id' => 27,
            'client_id' => 2,
            'notes' => 'Δοκιμαστική παραγγελία Εμπορίου (Έκθεσης)'
        ]);

        Order::create([
            'order_date' => '21-11-2021',
            'order_type' => 'Εμπόριο',
            'supplier_id' => 29,
            'client_id' => 1,
            'notes' => 'Δοκιμαστική παραγγελία Εργοστασίου'
        ]);


    }
}
