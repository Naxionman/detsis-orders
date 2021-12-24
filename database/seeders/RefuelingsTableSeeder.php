<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use \App\Models\Refueling;

class RefuelingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        Refueling::create([
            'refuel_date' => '15-12-2021',
            'vehicle_id' => '4',
            'amount' => '23.00',
        ]);

        Refueling::create([
            'refuel_date' => '22-12-2021',
            'vehicle_id' => '4',
            'amount' => '91.00',
        ]);

        Refueling::create([
            'refuel_date' => '17-12-2021',
            'vehicle_id' => '3',
            'amount' => '100.03',
        ]);

    }
}
