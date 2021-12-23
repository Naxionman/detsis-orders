<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Shipper;

class ShippersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        Shipper::create([
            'name' => 'Απ ευθείας παραλαβή',
        ]);

        Shipper::create([
            'name' => 'Dionysos Cargo',
            'phone' => '22850 26420',
            'website' => 'https://www.dionysoscargo.gr',
            'email' => 'info@dionysoscargo.gr',
        ]);

        Shipper::create([
            'name' => 'ΟΙΚΟΝΟΜΙΚΗ',
            'phone' => '210-346511, 2310-752211',
            'website' => 'http://metafores-oikonomiki.gr/',
            'email' => 'info@metafores-oikonomiki.gr',
        ]);

        Shipper::create([
            'name' => 'Άγιος Χριστόφορος',
            'phone' => '22850-22589',
            'website' => 'http://efan-naxou.gr',
            'email' => 'efan.naxou@gmail.com',
        ]);

        Shipper::create([
            'name' => 'ΣΦΑΙΡΑ',
            'phone' => '2310 785 100',
            'website' => 'https://sferatrans.gr/index.php/el/',
            'email' => 'sfairatrans@gmail.com',
        ]);

        Shipper::create([
            'name' => 'Speedex',
            'phone' => '',
            'website' => '',
            'email' => '',
        ]);

        Shipper::create([
            'name' => 'Γενική Ταχυδρομική',
            'phone' => '',
            'website' => '',
            'email' => '',
        ]);

        Shipper::create([
            'name' => 'ACS Courier',
            'phone' => '',
            'website' => '',
            'email' => '',
        ]);

        Shipper::create([
            'name' => 'ΕΛΤΑ Courier',
            'phone' => '',
            'website' => '',
            'email' => '',
        ]);

        

    }
}
