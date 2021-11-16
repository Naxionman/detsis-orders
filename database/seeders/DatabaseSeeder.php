<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EmployeesTableSeeder::class,
            ShippersTableSeeder::class,
            SuppliersTableSeeder::class,
            ProductsSeeder::class
        ]);
    }
}
