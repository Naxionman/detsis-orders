<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Vehicle;

class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Vehicle::create([
            'name' => 'Toyota Hilux',
            'plate'=>'EMH-1366',
            'fuel_type' => 'Diesel',
            'notes' => '',
        ]);

        Vehicle::create([
            'name' => 'Peugeot Partner',
            'plate'=>'EMT-4954',
            'fuel_type' => 'Diesel',
            'notes' => '',
        ]);

        Vehicle::create([
            'name' => 'Nissan Vehiculo',
            'plate'=>'EME-3400',
            'fuel_type' => 'Diesel',
            'notes' => '',
        ]);

        Vehicle::create([
            'name' => 'Ford Ranger',
            'plate' => 'EMT-4943',
            'fuel_type' => 'Diesel',
            'notes' => '',
        ]);
    }
}
