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
            'description' => 'Εργοστάσιο χημικά σιλικόνες',
        ]);
        
        \App\Models\Supplier::create([
            'company_name' => 'ADLER – Αφοί Ιωαννίδη και ΣΙΑ ΕΕ',
            'email' => 'adlergr@otenet.gr',
            'phone1' => '210 2710884',
            'website' => 'adlersal@otenet.gr',
            'afm' => '093567762',
            'address' => 'Βυζαντίου 42 Νέα Ιωνία',
            'city' => 'Αθήνα',
            'description' => 'Εργοστάσιο χρώματα',
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
            'description' => 'Εργοστάσιο υλικά επιπλοποιίας',
            
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'Μ.Βράτιμος - Π.Παπαδόπουλος Ο.Ε. (Woodman)',
            'email' => 'vratimos@woodman.gr',
            'phone1' => '2710 233847',
            'website' => 'https://www.woodman.gr/',
            'address' => 'ΒΙ.ΠΕ.ΤΡΙΠΟΛΗΣ',
            'city' => 'Αρκαδία',
            'description' => 'Εργοστάσιο ξυλεία',
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'ΒΥΡΤ ΕΛΛΑΣ ΑΕΒΕ  (WURTH)',
            'email' => 'info@wurth.gr',
            'phone1' => '210 6290800',
            'website' => 'https://www.wurth.gr/',
            'afm' => '094231373',
            'address' => '23ο χλμ. Αθηνών-Λαμίας',
            'city' => 'Κρυονέρι',
            'description' => 'Εργοστάσιο Υλικά συναρμολόγησης',
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
            'description' => 'Εργοστάσιο Υλικά επιπλοποιίας μεντεσέδες κουμπάσα',
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'Βαμβακάς Βιομηχανικός εξοπλισμός ΑΕ',
            'email' => 'info@vamvacas.gr',
            'phone1' => '210 4208707',
            'website' => 'https://www.vamvacas.gr/',
            'afm' => '094231430',
            'address' => 'Δ. Μουτσοπούλου 103',
            'city' => 'Πειραιάς',
            'description' => 'Εργοστάσιο βιομηχανικός εξοπλισμός εργαλεία εξαρτήματα',
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'Wood Profile Μ.ΕΠΕ',
            'email' => 'info@woodprofile.com',
            'phone1' => '210 6628544',
            'website' => 'http://www.woodprofile.com/',
            'afm' => '998088862',
            'address' => 'Αρχιμήδους 30',
            'city' => 'Κορωπί',
            'description' => 'Εργοστάσιο είδη ξύλου ξυλεία',
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'ΓΛΥΚΟΣ Ο.Ε.',
            'email' => 'glykosoe@otenet.gr',
            'phone1' => '22210 83502',
            'phone2' =>'22210 42430',
            'website' => 'https://www.glykos.com.gr/',
            'afm' => '082722797',
            'address' => 'Αρεθούσης 70-72Α',
            'city' => 'Χαλκίδα',
            'description' => 'Εργοστάσιο πορτάκια',
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'ΣΩΤΗΡΗΣ & ΠΕΤΡΟΣ ΔΗΜΟΥ Ο.Ε.',
            'email' => 'info@dimou.com.gr',
            'phone1' => '2310 667266',
            'website' => 'https://dimou.com.gr/',
            'afm' => '998875439',
            'address' => 'Βι Πα Ωραιοκάστρου',
            'city' => 'Θεσσαλονίκη',
            'description' => 'Εργοστάσιο αλουμίνιο τζάμι μηχανισμοί συρόμενων',
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'ΕΥΡΩΤΕΧΝΙΚΗ Ε.Π.Ε.  - Eurotecnica Roto',
            'email' => 'info@eurotechnica.gr',
            'phone1' => '210 9959397',
            'website' => 'https://www.eurotechnica.gr/',
            'afm' => '095385243',
            'address' => 'Λεωφόρος Σπάτων 151',
            'city' => 'Παλλήνη',
            'description' => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'ΕΛΕΥΘΕΡΙΟΥ Α.Ε.',
            'email' => 'info@eleftheriou-sa.gr',
            'phone1' => '2310 781822',
            'website' => 'https://www.eleftheriou-sa.gr/',
            'afm' => '999124156',
            'address' => '2ο χλμ. Συμμαχικής οδού Διαβατών Ωραιοκάστρου',
            'city' => 'Θεσσαλονίκη',
            'description' => 'Εργοστάσιο πορτάκια ',
        ]);

        \App\Models\Supplier::create([
            'company_name' => 'ΕΛΑΣΤΡΟΝ ΑΕΒΕ',
            'email' => '',
            'phone1' => '210 5515000',
            'website' => 'https://www.elastron.gr/',
            'afm' => '094018802',
            'address' => 'θέση Άγιος Ιωάννης',
            'city' => 'Ασπρόπυργος',
            'description' => 'Εργοστάσιο πάνελ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'ΖΩΓΟΜΕΤΑΛ ΑΕΒΕ',
            'salesman'      => '',
            'email'         => 'info@zogometal.com',
            'phone1'        => '210 6626465',
            'website'       => 'https://zogometal.com/',
            'afm'           => '998385150',
            'address'       => '4ο χλμ. Κορωπίου-Βάρης',
            'city'          => 'Κορωπί',
            'description'   => 'Εργοστάσιο πόμολα μάσκουλα',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'ΖΑΛΩΝΗ ΑΦΟΙ Ο.Ε.',
            'email'         => 'info@zalonis.eu',
            'phone1'        => '210 9613206',
            'website'       => 'https://zalonis.eu/',
            'afm'           => '082701255',
            'address'       => 'Βορείου Ηπείρου 40 Γλυφάδα',
            'city'          => 'Αθήνα',
            'description'   => 'Εργοστάσιο μηχανισμοί συρόμενων',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Θεοδοσιάδης Κ. Α.Ε.',
            'salesman'      => '',
            'email'         => 'info@theodosiadis.gr',
            'phone1'        => '210 4205890',
            'website'       => 'https://www.theodosiadis.gr/',
            'address'       => 'Παπαστράτου 10 & Χαϊδαρίου 13',
            'city'          => 'Πειραιάς',
            'description'   => 'Εργοστάσιο ανοξείδωτα',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Κοντογεώργου Ε.Π.Ε.',
            'email'         => 'carve@otenet.gr',
            'phone1'        => '22950 29946',
            'website'       => 'https://carve.gr/',
            'afm'           => '092541411',
            'address'       => 'Κεφαλληνίας 28 Ηλιούπολη',
            'city'          => 'Αθήνα',
            'description'   => 'Εργοστάσιο πορτάκια ημιμασίφ ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Κανελλόπουλος Αν. Ι.Κ.Ε. ',
            'email'         => 'sales@woodkanellopoulos.gr',
            'phone1'        => '210 9752147',
            'website'       => 'https://woodkanellopoulos.gr/',
            'address'       => 'Αισχύλου 6 - Άγιος Δημήτριος',
            'city'          => 'Αθήνα',
            'description'   => 'Εργοστάσιο πορτάκια',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Κανέλλη Α.Ε.Ε.',
            'salesman'      => '',
            'email'         => 'info@kanelli.eu',
            'phone1'        => '210 4134972',
            'phone2'        => 'Υποκατάστημα: 2105551654',
            'website'       => 'https://kanelli.eu/',
            'afm'           => '',
            'address'       => 'Ομηρίδου Σκυλίτση 10',
            'city'          => 'Πειραιάς',
            'description'   => 'Εργοστάσιο πορτάκια',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Καριανάκης Κωνσταντίνος Greenroof',
            'salesman'      => '',
            'email'         => '',
            'phone1'        => '',
            'website'       => '',
            'afm'           => '',
            'address'       => '',
            'city'          => '',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => '',
            'salesman'      => '',
            'email'         => '',
            'phone1'        => '',
            'website'       => '',
            'afm'           => '',
            'address'       => '',
            'city'          => '',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => '',
            'salesman'      => '',
            'email'         => '',
            'phone1'        => '',
            'website'       => '',
            'afm'           => '',
            'address'       => '',
            'city'          => '',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => '',
            'salesman'      => '',
            'email'         => '',
            'phone1'        => '',
            'website'       => '',
            'afm'           => '',
            'address'       => '',
            'city'          => '',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => '',
            'salesman'      => '',
            'email'         => '',
            'phone1'        => '',
            'website'       => '',
            'afm'           => '',
            'address'       => '',
            'city'          => '',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => '',
            'salesman'      => '',
            'email'         => '',
            'phone1'        => '',
            'website'       => '',
            'afm'           => '',
            'address'       => '',
            'city'          => '',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => '',
            'salesman'      => '',
            'email'         => '',
            'phone1'        => '',
            'website'       => '',
            'afm'           => '',
            'address'       => '',
            'city'          => '',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => '',
            'salesman'      => '',
            'email'         => '',
            'phone1'        => '',
            'website'       => '',
            'afm'           => '',
            'address'       => '',
            'city'          => '',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => '',
            'salesman'      => '',
            'email'         => '',
            'phone1'        => '',
            'website'       => '',
            'afm'           => '',
            'address'       => '',
            'city'          => '',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => '',
            'salesman'      => '',
            'email'         => '',
            'phone1'        => '',
            'website'       => '',
            'afm'           => '',
            'address'       => '',
            'city'          => '',
            'description'   => 'Εργοστάσιο ',
        ]);


    }
}
