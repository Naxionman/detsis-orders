<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        Client::create ([
            'surname'   => 'Εργοστάσιο',
            'name'      => '',
        ]);

        Client::create ([
            'surname'   => 'Αλιμπέρτης',
            'name'      => 'Διονύσης',
        ]);
        
        Client::create ([
            'surname'   => 'Aoun',
            'name'      => 'Raymond',
        ]);
        
        Client::create ([
            'surname'   => 'Τσιχλάκης',
            'name'      => 'Κώστας',
        ]);
        
        Client::create ([
            'surname'   => 'Μαρούλης',
            'name'      => 'Μιχάλης',
        ]);
        
        Client::create ([
            'surname'   => 'Κιουλαφή',
            'name'      => 'Ίρινα',
        ]);
        
        Client::create ([
            'surname'   => 'Ψαρρά',
            'name'      => 'Άννα',
        ]);
        
        Client::create ([
            'surname'   => 'Δρόσου',
            'name'      => 'Άννα',
        ]);
        
        Client::create ([
            'surname'   => 'Παραράς',
            'name'      => 'Γιάννης',
        ]);
        
        Client::create ([
            'surname'   => 'Κουτάντζης',
            'name'      => 'Σπύρος',
        ]);
        
        Client::create ([
            'surname'   => 'Πράσινος',
            'name'      => 'Γιάννης',
        ]);
        
        Client::create ([
            'surname'   => 'Καλαργυρού',
            'name'      => 'Μαρουσώ',
        ]);
        
        Client::create ([
            'surname'   => 'Καπίρη',
            'name'      => 'Ροδούλα',
        ]);
        
    }
}
