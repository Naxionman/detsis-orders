<?php

namespace Database\Seeders;

use App\Models\Insurance;
use Illuminate\Database\Seeder;

class InsurancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        Insurance::create([
            'insurance_date'=>'2021-08-17',
            'expiry_date'=>'2022-08-17',
            'insurance_company'=>'Υδρόγειος',
            'amount'=>'148',
            'vehicle_id'=>'1',
        ]);

        Insurance::create([
            'insurance_date'=>'2021-12-06',
            'expiry_date'=>'2022-12-06',
            'insurance_company'=>'Υδρόγειος',
            'amount'=>'102',
            'vehicle_id'=>'2',
        ]);

        Insurance::create([
            'insurance_date'=>'2021-01-15',
            'expiry_date'=>'2022-01-15',
            'insurance_company'=>'Υδρόγειος',
            'amount'=>'162',
            'vehicle_id'=>'3',
        ]);
    }
}
