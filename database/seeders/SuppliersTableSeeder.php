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
            'company_name'  => 'Accessories – Αθανασιάδης Δημήτριος',
            'email'         => 'a.d.2accessories@gmail.com',
            'phone1'        => '6972 264 042',
            'description'   => 'Εργοστάσιο χημικά σιλικόνες',
        ]);
        
        \App\Models\Supplier::create([
            'company_name'  => 'ADLER – Αφοί Ιωαννίδη και ΣΙΑ ΕΕ',
            'email'         => 'adlergr@otenet.gr',
            'phone1'        => '210 2710884',
            'website'       => 'adlersal@otenet.gr',
            'afm'           => '093567762',
            'address'       => 'Βυζαντίου 42 Νέα Ιωνία',
            'city'          => 'Αθήνα',
            'description'   => 'Εργοστάσιο χρώματα',
        ]);

        \App\Models\Supplier::create([
            'company_name'  => 'Αρνάκης Δημ. Βασίλειος – Trusttools',
            'email'         => 'info@trusttools.gr',
            'phone1'        => '210 9649810',
            'website'       => 'https://www.trusttools.gr/',
            'afm'           => '044744207',
            'address'       => 'Μετσόβου 18 Γλυφάδα',
            'city'          => 'Αθήνα',
            'description'   => 'Βιομηχανικά εργαλεία',
        ]);
        
        \App\Models\Supplier::create([
            'company_name'  => 'Βογιατζόγλου Systems A.E.',
            'salesman'      => 'Σάκης 6971545749',
            'email'         => 'info@voyatzoglou.gr',
            'phone1'        => '210 5553300',
            'phone2'        => '210 2888600',
            'website'       => 'https://www.voyatzoglou.gr/',
            'afm'           => '094353573',
            'address'       => '12ο χλμ. Αθηνών – Λαμίας',
            'city'          => 'Μεταμόρφωση',
            'description'   => 'Εργοστάσιο υλικά επιπλοποιίας',
            
        ]);

        \App\Models\Supplier::create([
            'company_name'  => 'Μ.Βράτιμος - Π.Παπαδόπουλος Ο.Ε. (Woodman)',
            'email'         => 'vratimos@woodman.gr',
            'phone1'        => '2710 233847',
            'website'       => 'https://www.woodman.gr/',
            'address'       => 'ΒΙ.ΠΕ.ΤΡΙΠΟΛΗΣ',
            'city'          => 'Αρκαδία',
            'description'   => 'Εργοστάσιο ξυλεία',
        ]);

        \App\Models\Supplier::create([
            'company_name'  => 'ΒΥΡΤ ΕΛΛΑΣ ΑΕΒΕ  (WURTH)',
            'email'         => 'info@wurth.gr',
            'phone1'        => '210 6290800',
            'website'       => 'https://www.wurth.gr/',
            'afm'           => '094231373',
            'address'       => '23ο χλμ. Αθηνών-Λαμίας',
            'city'          => 'Κρυονέρι',
            'description'   => 'Εργοστάσιο Υλικά συναρμολόγησης',
        ]);

        \App\Models\Supplier::create([
            'company_name'  => 'BLUM ΕΛΛΑΣ ΑΕΒΕ',
            'salesman'      => 'Δημήτρης: 6945109765 Δήμητρα Δραγώνα: dimitra.dragona@blum.com',
            'email'         => 'info.gr@blum.com',
            'phone1'        => '210 2751131',
            'website'       => 'https://www.blum.com/gr/el/',
            'afm'           => '094251741',
            'address'       => '19ο χλμ. Παιανίας-Μαρκόπουλου',
            'city'          => 'Παιανία',
            'description'   => 'Εργοστάσιο Υλικά επιπλοποιίας μεντεσέδες κουμπάσα',
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
            'email'         => 'info@kanelli.eu',
            'phone1'        => '210 4134972',
            'phone2'        => 'Υποκατάστημα: 2105551654',
            'website'       => 'https://kanelli.eu/',
            'address'       => 'Ομηρίδου Σκυλίτση 10',
            'city'          => 'Πειραιάς',
            'description'   => 'Εργοστάσιο πορτάκια',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Καριανάκης Κωνσταντίνος Greenroof',
            'email'         => 'info@greenroof.gr',
            'phone1'        => '210 9231052',
            'website'       => 'https://www.greenroof-eshop.com/',
            'afm'           => '044242500',
            'address'       => 'Σαπφούς 35 Καλλιθέα',
            'city'          => 'Αθήνα',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Λινάκης Μ. Α.Ε.',
            'email'         => 'sales@ra-ba.gr',
            'phone1'        => '210 9411509',
            'website'       => 'https://www.ra-ba.gr/',
            'afm'           => '094462882',
            'address'       => 'Ανδρέα Μουράτη 24',
            'city'          => 'Πειραιάς',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Μαριόγλου ΑΦΟΙ ΑΒΕΕ',
            'salesman'      => 'Κατερίνα',
            'email'         => 'info@marioglou.gr',
            'phone1'        => '2310 474084',
            'website'       => 'https://www.marioglou.gr/',
            'address'       => '5ο χλμ. Θεσσαλονίκης-Θέρμης',
            'city'          => 'Θεσσαλονίκη',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Madeira',
            'email'         => 'info@madeira.gr',
            'phone1'        => '210 6230972',
            'website'       => 'http://www.madeira.gr/',
            'afm'           => '094352238',
            'address'       => 'Τοσίτσα 4 Κηφισιάς',
            'city'          => 'Αθήνα',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'ASH - Hafele ΜΟΥΡΔΟΥΚΟΥΤΑΣ ΙΚΕ',
            'salesman'      => '',
            'email'         => 'info@ash.gr',
            'phone1'        => '210 2519681',
            'website'       => 'https://ash.gr/el-gr/',
            'afm'           => '081175449',
            'address'       => 'Θεσσαλονίκης 113 Νέα Φιλαδέλφια',
            'city'          => 'Αθήνα',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'METALOR ΑΒΕΕ',
            'email'         => 'Ασπρόπυργος',
            'phone1'        => '210 5599690',
            'website'       => 'https://metalor.com.gr/',
            'afm'           => '094507216',
            'address'       => 'Γκορυτσάς 564 Ασπρόπυργος Αττικής',
            'city'          => 'Ασπρόπυργος',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Ματράκας Αθανάσιος',
            'email'         => 'info@matrakas.gr',
            'phone1'        => '22280 25252',
            'website'       => 'https://www.matrakas.gr/',
            'afm'           => '028733936',
            'address'       => 'Πάροδος, Αγγελή Γοβιού 50-52 Ψαχνά Ευβοίας',
            'city'          => 'Εύβοια',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Πραξιτέλης Α.Ε.',
            'email'         => 'info@praxitelis-sa.gr',
            'phone1'        => '27410 24952',
            'website'       => 'https://www.praxitelis-sa.gr/',
            'address'       => 'Μπαθαρίστρα Κορίνθου',
            'city'          => 'Κόρινθος',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Παπαδόπουλος Ηλίας – Papadopoulos Tools',
            'salesman'      => '',
            'email'         => 'info@papadopoulostools.com',
            'phone1'        => '210 9943623',
            'website'       => 'https://www.papadopoulostools.com/',
            'afm'           => '052082791',
            'address'       => 'Πλουτάρχου 65 Άγιος Δημήτριος',
            'city'          => 'Αθήνα',
            'description'   => 'Εργοστάσιο',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Προμηθεύς - Μ. Παπαδοπούλου - Χ. Τερψίδης Ο.Ε.',
            'email'         => 'sales@prometheus.gr',
            'phone1'        => '210 4131716',
            'website'       => 'https://prometheus.gr/default.asp',
            'afm'           => '091829090',
            'address'       => 'Γούναρη Δημητρίου 31',
            'city'          => 'Πειραιάς',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Paramina ΑΕΒΕ',
            'email'         => 'info@paramina.gr',
            'phone1'        => '210 5575860',
            'website'       => 'https://www.paramina-compressors.com/',
            'afm'           => '095028995',
            'address'       => 'Πάροδος Ευαγγελιστρίας 245',
            'city'          => 'Ασπρόπυργος',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Ραπτόπουλος Μ. Α.Ε.',
            'email'         => 'info@raptopoulosae.gr',
            'phone1'        => '2310 461797',
            'website'       => 'https://raptopoulosae.gr/',
            'afm'           => '094220278',
            'address'       => 'Θέρμη – Θεσσαλονίκη',
            'city'          => 'Θεσσαλονίκη',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Rimar Ε.Π.Ε.',
            'email'         => 'info@rimar.gr',
            'phone1'        => '22620 73054',
            'website'       => 'https://rimar.gr/',
            'afm'           => '998328327',
            'address'       => 'Εθνική οδός Θήβας-Χαλκίδας',
            'city'          => 'Σχηματάρι',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'SILVES',
            'salesman'      => '',
            'email'         => 'info@silves.gr',
            'phone1'        => '22620 72190',
            'website'       => 'https://silves.gr/',
            'afm'           => '999873641',
            'address'       => 'Θέση Βρύσες, Βαθύ Αυλίδας',
            'city'          => 'Σχηματάρι',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Δημητρακόπουλοι Αφοι Ο.Ε. ΣΥΡΤΕΞ',
            'salesman'      => '',
            'email'         => '',
            'phone1'        => '210 8161252',
            'website'       => '',
            'afm'           => '081487840',
            'address'       => '23ο χλμ. Αθηνών-Λαμίας',
            'city'          => 'Κρυονέρι',
            'description'   => 'Εργοστάσιο ',
        ]);
        
        \App\Models\Supplier::create ([
            'company_name'  => 'SYNCRO AE',
            'salesman'      => '',
            'email'         => 'info@syncro.gr',
            'phone1'        => '23940 20406',
            'website'       => 'http://www.syncro.gr/',
            'afm'           => '',
            'address'       => '15,5o χλμ. Θες/νίκης-Καβάλας',
            'city'          => 'Λαγκαδάς',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Συνοδιάς Ι.Β. Α.Ε.',
            'salesman'      => 'Γιώργος Μιμίκος 697 28 29 284',
            'email'         => 'info@sinodias.com',
            'phone1'        => '23940 72770',
            'website'       => 'http://www.sinodias.com/',
            'afm'           => '999124758',
            'address'       => '15o χλμ. Θες/νίκης-Καβάλας',
            'city'          => 'Λαγκαδάς',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Sideco - Οικονομίδης Σ. & Δ.  Ο.Ε.',
            'salesman'      => '',
            'email'         => 'info@sideco.gr',
            'phone1'        => '210 4913713',
            'website'       => 'https://www.sideco.gr/',
            'afm'           => '082346032',
            'address'       => 'Ιθάκης 39 Αγ.Ιωάννης Ρέντης',
            'city'          => 'Πειραιάς',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Σαχλός Α. - Timbersa',
            'salesman'      => '',
            'email'         => 'info@xyleia-athina.gr',
            'phone1'        => '210 2460171',
            'website'       => 'https://www.timbersafloor.gr/',
            'afm'           => '998993260',
            'address'       => 'Λεωφόρος Καραμανλή 190',
            'city'          => 'Αχαρνές',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Σακαλάκης Μιχαήλ',
            'salesman'      => '',
            'email'         => 'sakal1@otenet.gr',
            'phone1'        => '210 5711051',
            'website'       => 'https://sakalakis.com/',
            'afm'           => '998279170',
            'address'       => 'Παλαιάς Καβάλας 240 Περιστέρι',
            'city'          => 'Αθήνα',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Σίντερ Ελλάς Ε.Π.Ε.',
            'salesman'      => '',
            'email'         => 'sinter.hellas@gmail.com',
            'phone1'        => '210 3477332',
            'website'       => 'http://www.sinter-hellas.gr/',
            'afm'           => '095029304',
            'address'       => 'Πέτρου Ράλλη 35 Ταύρος',
            'city'          => 'Αθήνα',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Σαρρής Μηχανήματα ΑΕΒΕ',
            'salesman'      => '',
            'email'         => 'info@sarris-machinery.gr',
            'phone1'        => '2810 261213',
            'website'       => 'https://sarris-machinery.gr/',
            'afm'           => '998090894',
            'address'       => 'Παπαγιάννη Σκουλά & Ηρακλή',
            'city'          => 'Ηράκλειο',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Χατζηιωάννου Κωνσταντίνος – Sokratis',
            'email'         => 'info@sokratis.com.gr',
            'phone1'        => '210 5778748',
            'website'       => 'http://www.sokratis.com.gr/',
            'afm'           => '067062008',
            'address'       => 'Τερπάνδρου 47 Περιστέρι',
            'city'          => 'Αθήνα',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'ΧΗΜΙΚΟΔΟΜΙΚΗ Α.Ε.',
            'email'         => 'info@chimikodomiki.gr',
            'phone1'        => '2310 420125',
            'website'       => 'https://www.chimikodomiki.gr/el/',
            'afm'           => '095063125',
            'address'       => 'Βασιλίσσης Όλγας 220',
            'city'          => 'Θεσσαλονίκη',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Χαμπάκης Σ.Ε. & ΣΙΑ',
            'salesman'      => '',
            'email'         => 'info@habakis.gr',
            'phone1'        => '210 8074710',
            'website'       => 'https://www.habakis.gr/',
            'afm'           => '082205954',
            'address'       => 'Υψηλάντου 4 Κηφισιά',
            'city'          => 'Αθήνα',
            'description'   => 'Εργοστάσιο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Varvaresos Doors',
            'email'         => 'varvaresosgr@hotmail.com',
            'phone1'        => '26230 54968',
            'website'       => 'https://varvaresosdoors.com/',
            'afm'           => '',
            'address'       => 'Ε.Ο. Ανδραβίδας - Κυλλήνης',
            'city'          => 'Ανδραβίδα Ηλείας',
            'description'   => 'Εμπόριο πόρτες',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'FRANKE',
            'salesman'      => '',
            'email'         => 'ks-orders.gr@franke.com',
            'phone1'        => '2299150011-12',
            'website'       => 'https://www.franke.com/gr/el/hs.html',
            'afm'           => '',
            'address'       => '',
            'city'          => '',
            'description'   => 'Εμπόριο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Μπακλατσίδης',
            'email'         => 'sales@baklatsidis.gr',
            'phone1'        => '2310 463 135',
            'phone2'        => '210 800 2929',
            'website'       => 'https://www.baklatsidis.gr/index.php',
            'afm'           => '',
            'address'       => '14ο χλμ Θεσ/νίκης - Βασιλικών, 570 01 Θέρμη',
            'city'          => 'Θεσσαλονίκη',
            'description'   => 'Εμπόριο ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'VS Doors',
            'salesman'      => 'Σιδηρόπουλος Βασίλης',
            'email'         => 'info@vs-windows-doors.gr',
            'phone1'        => '6948834882',
            'website'       => 'https://vs-windows-doors.gr/',
            'city'          => 'Αθήνα',
            'description'   => 'Εμπόριο  ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'Σάλτας Χρήστος & Υιοί',
            'salesman'      => '',
            'email'         => 'X_Saltas_Yioi@yahoo.gr',
            'phone1'        => '2296034032',
            'website'       => 'https://www.xsaltas.gr/',
            'afm'           => '',
            'address'       => '28ης Οκτωβρίου 383Β',
            'city'          => 'Μέγαρα',
            'description'   => 'Εμπόριο κουφώματα ',
        ]);

        \App\Models\Supplier::create ([
            'company_name'  => 'ΤΖΙ ΕΣ - GS',
            'salesman'      => 'Ιωάννα Πέγκα',
            'email'         => 'clients@g-s.gr',
            'phone1'        => '22990 49880 – 2',
            'website'       => 'https://www.g-s.gr/',
            'afm'           => '',
            'address'       => 'Λεωοφόρος Καλαμακίου 70 Άλιμος',
            'city'          => 'Αθήνα',
            'description'   => 'Εμπόριο σήτες ',
        ]);


    }
}
