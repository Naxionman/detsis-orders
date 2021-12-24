<?php

namespace Database\Seeders;

use App\Models\Kteo;
use Illuminate\Database\Seeder;

class KteosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kteo::create([
            'kteo_date' => '1821-3-25',
            'next_kteo_date' => '1821-3-25',
            'vehicle_id' => '1',
            'amount' => '0',
        ]);

        Kteo::create([
            'kteo_date' => '2019-11-19',
            'next_kteo_date' => '2021-11-19',
            'vehicle_id' => '2',
            'amount' => '0',
        ]);

        Kteo::create([
            'kteo_date' => '2019-12-18',
            'next_kteo_date' => '2021-12-18',
            'vehicle_id' => '3',
            'amount' => '0',
        ]);

        Kteo::create([
            'kteo_date' => '2021-12-20',
            'next_kteo_date' => '2023-12-20',
            'vehicle_id' => '3',
            'amount' => '80.00',
        ]);

        Kteo::create([
            'kteo_date' => '2021-12-24',
            'next_kteo_date' => '2023-12-24',
            'vehicle_id' => '1',
            'amount' => '80.00',
        ]);

    }
}
