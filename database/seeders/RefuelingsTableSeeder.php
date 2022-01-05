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

        Refueling::create([
            'refuel_date' => '17-12-2021',
            'vehicle_id' => '3',
            'amount' => '100.03',
        ]);

        Refueling::create([
            'refuel_date' => '31-12-2021',
            'vehicle_id' => '4',
            'amount' => '87.00',
        ]);

        Refueling::create([
            'refuel_date' => '3-1-2022',
            'vehicle_id' => '2',
            'amount' => '50.00',
        ]);

        Refueling::create([
            'refuel_date' => '27-12-2021',
            'vehicle_id' => '4',
            'amount' => '25.02',
        ]);

        Refueling::create([
            'refuel_date' => '24-12-2021',
            'vehicle_id' => '4',
            'amount' => '36.00',
        ]);

        Refueling::create([
            'refuel_date' => '28-12-2021',
            'vehicle_id' => '4',
            'amount' => '50.00',
        ]);

        Refueling::create([
            'refuel_date' => '23-12-2021',
            'vehicle_id' => '4',
            'amount' => '58.01',
        ]);

    }
}
