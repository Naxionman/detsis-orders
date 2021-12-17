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
            ClientsTableSeeder::class,
            EmployeesTableSeeder::class,
            SuppliersTableSeeder::class,
            VehiclesTableSeeder::class,
            ShippersTableSeeder::class,
            InsurancesTableSeeder::class,
            KteosTableSeeder::class,
            PaymentsTableSeeder::class,
            ProductsTableSeeder::class,
            RefuelingsTableSeeder::class,
        ]);
    }
}
