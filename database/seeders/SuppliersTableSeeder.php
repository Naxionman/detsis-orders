<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Models\Supplier::create([
            'company_name' => 'Accessories – Αθανασιάδης Δημήτριος',
            'phone1' => '6972 264 042',
            'description' => 'Εμπόριο υλικών κουφωμάτων',
        ]);
        
        \App\Models\Supplier::create([
            'company_name' => 'ADLER – Αφοί Ιωαννίδη και ΣΙΑ ΕΕ',
            'email' => 'adlersal@otenet.gr',
            'phone1' => '210 2710884',
            'website' => 'adlersal@otenet.gr',
            'afm' => '093567762',
            'address' => 'Βυζαντίου 42 Νέα Ιωνία',
            'city' => 'Αθήνα',
            'description' => 'Εμπορία Χρωμάτων',
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'Αρνάκης Δημ. Βασίλειος – Trusttools',
            'email' => 'info@trusttools.gr',
            'phone1' => '210 9649810',
            'website' => 'https://www.trusttools.gr/',
            'afm' => '044744207',
            'address' => 'Μετσόβου 18 Γλυφάδα',
            'city' => 'Αθήνα',
            'description' => 'Βιομηχανικά εργαλεία',
        ]);
        
        \App\Models\Supplier::create([
            'company_name' => 'Βογιατζόγλου Systems A.E.',
            'salesman' => 'Σάκης 6971545749',
            'email' => 'info@voyatzoglou.gr',
            'phone1' => '210 5553300',
            'phone2' => '210 2888600',
            'website' => 'https://www.voyatzoglou.gr/',
            'afm' => '094353573',
            'address' => '12ο χλμ. Αθηνών – Λαμίας',
            'city' => 'Μεταμόρφωση',
            
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'Μ.Βράτιμος - Π.Παπαδόπουλος Ο.Ε. (Woodman)',
            'email' => 'vratimos@woodman.gr',
            'phone1' => '2710 233847',
            'website' => 'https://www.woodman.gr/',
            'address' => 'ΒΙ.ΠΕ.ΤΡΙΠΟΛΗΣ',
            'city' => 'Αρκαδία',
            'description' => 'Εμπορία Ξυλείας-Σύνθετων',
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'ΒΥΡΤ ΕΛΛΑΣ ΑΕΒΕ  (WURTH)',
            'email' => 'info@wurth.gr',
            'phone1' => '210 6290800',
            'website' => 'https://www.wurth.gr/',
            'afm' => '094231373',
            'address' => '23ο χλμ. Αθηνών-Λαμίας',
            'city' => 'Κρυονέρι',
            'description' => 'Υλικά συναρμολόγησης',
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'BLUM ΕΛΛΑΣ ΑΕΒΕ',
            'salesman' => 'Δημήτρης: 6945109765 Δήμητρα Δραγώνα: dimitra.dragona@blum.com',
            'email' => 'info.gr@blum.com',
            'phone1' => '210 2751131',
            'website' => 'https://www.blum.com/gr/el/',
            'afm' => '094251741',
            'address' => '19ο χλμ. Παιανίας-Μαρκόπουλου',
            'city' => 'Παιανία',
            'description' => 'Υλικά επιπλοποιίας',
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'Vyshnevskiy Igor',
            'email' => 'vialex.hellas@gmail.com',
            'phone1' => '210 9731940',
            'website' => 'https://www.vialexshop.gr/',
            'afm' => '112153860',
            'address' => 'Ηπείρου 38 Ηλιούπολη',
            'city' => 'Αθήνα',
            'description' => 'Μηχανισμοί για ντουλάπες',
        ]);

    }
}
