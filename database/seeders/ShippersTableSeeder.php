<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Shipper::create([
            'name' => 'Dionysos Cargo',
            'phone' => '22850 26420',
            'website' => 'https://www.dionysoscargo.gr',
            'email' => 'info@dionysoscargo.gr',
        ]);

        \App\Models\Shipper::create([
            'name' => 'ΟΙΚΟΝΟΜΙΚΗ',
            'phone' => '210-346511, 2310-752211',
            'website' => 'http://metafores-oikonomiki.gr/',
            'email' => 'info@metafores-oikonomiki.gr',
        ]);


    }
}
