<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'detsis_code' => 'SHOWROOM',
            'product_code'=> 'SHOWROOM',
            'product_name'=> 'Προϊόντα παραγγελίας από Έκθεση',
            'notes' => 'Κωδικός για να μπορούμε να καταγράφουμε τα ποσά και τις μεταφορικές'
        ]);

        Product::create([
            'detsis_code' => 'NoStock',
            'product_code'=> 'NoStock',
            'product_name'=> 'Προϊόντα μη αποθεματικής παραγγελίας εργοστασίου',
            'notes' => 'Κωδικός για να μπορούμε να καταγράφουμε τις μη αποθεματικές παραγγελίες του εργοστασίου'
        ]);

        Product::create([
            'detsis_code' => 'extra',
            'product_code'=> 'extra',
            'product_name'=> 'Άλλες χρεώσεις',
            'notes' => 'Κωδικός για να μπορούμε να καταγράφουμε τις επιπλέον χρεώσεις που τοποθετούνται ως προϊόντα'
        ]);

        Product::create([
            'detsis_code' => '0202-01',
            'product_code'=> '4-1132',
            'product_name'=> 'MS ARASEAL 225 ΛΕΥΚΟ 290ML',
            'notes' => 'Σιλικόνη λευκή εξωτερικού χώρου',
            'image_url' => 'MS ARASEAL 225 ΛΕΥΚΟ 290ML.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0202-02',
            'product_code'=> '4-1130',
            'product_name'=> 'MS ARASEAL 225 ΛΕΥΚΟ 600ML',
            'notes' => 'Σιλικόνη λευκή εξωτερικού χώρου ΣΑΛΑΜΙ',
            'image_url' => 'MS ARASEAL 225 ΛΕΥΚΟ 600ML.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0202-03',
            'product_code'=> '4-1157',
            'product_name'=> 'MS ARA SMP35 ΛΕΥΚΟ 600ML',
            'notes' => ' ΣΑΛΑΜΙ',
            'image_url' => 'MS ARA SMP35 ΛΕΥΚΟ 600ML.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0202-04',
            'product_code'=> '4-1144',
            'product_name'=> 'MS COSMOFIX-CRYSTAL HD-150.160 290ML',
            'notes' => 'Υβριδική κόλλα',
            'image_url' => 'MS COSMOFIX-CRYSTAL HD-150.160 290ML.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0205-01',
            'product_code'=> '2-0062',
            'product_name'=> 'ΠΙΣΤΟΛΙ ΣΙΛΙΚ. SKW',
            'notes' => 'Πιστόλι σιλικόνης',
            'image_url' => 'ΠΙΣΤΟΛΙ ΣΙΛΙΚ. SKW.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0205-02',
            'product_code'=> '2-0062',
            'product_name'=> 'ΠΙΣΤΟΛΙ ΑΦΡΟΥ PL-9403',
            'notes' => 'Πιστόλι αφρού',
            'image_url' => 'ΠΙΣΤΟΛΙ ΑΦΡΟΥ PL-9403.jpg'
        ]);

        Product::create([
            'detsis_code' => '0201-01',
            'product_code'=> '2-0213',
            'product_name'=> 'ΣΙΛΙΚ. DURASIL W15 PLUS ΔΙΑΦ. 310ML',
            'notes' => 'Σιλικόνη διάφανη',
            'image_url' => 'DURASIL W15 PLUS 310ML ΔΙΑΦΑΝΗ.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0201-02',
            'product_code'=> '2-0236',
            'product_name'=> 'ΣΙΛΙΚ. DURASIL W15 PLUS ΚΑΦΕ 310ML',
            'notes' => 'Σιλικόνη λευκή',
            'image_url' => 'DURASIL W15 PLUS 310ML ΚΑΦΕ.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0206-01',
            'product_code'=> '2-0026',
            'product_name'=> 'SILIKON SPRAY',
            'notes' => 'Spray σιλικόνης',
            'image_url' => 'SILICON SPRAY.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0203-01',
            'product_code'=> '4-0014',
            'product_name'=> 'ΚΑΘΑΡ.PVC No5',
            'notes' => 'Καθαριστικό PVC Νο.5',
            'image_url' => 'ΚΑΘΑΡ. PVC No 5.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0204-01',
            'product_code'=> '1-0005',
            'product_name'=> 'ARAPURAN SPEED 750ML',
            'notes' => 'Αφρός πολυουρεθάνης',
            'image_url' => 'ARAPURAN SPEED 750ML.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0204-02',
            'product_code'=> '1-0014',
            'product_name'=> 'ARAPURAN SYN 750ML',
            'notes' => 'Αφρός πολυουρεθάνης',
            'image_url' => 'ARAPURAN SYN 750ML.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0201-03',
            'product_code'=> '2-0279',
            'product_name'=> 'ARACRYLAN 200 310ML ΛΕΥΚΟ',
            'notes' => 'Σιλικόνη λευκή',
            'image_url' => 'ARACRYLAN 200 310ML ΛΕΥΚΟ.jpg'
        ]);

        Product::create([
            'detsis_code' => '0201-04',
            'product_code'=> '2-0196',
            'product_name'=> 'ΣΙΛΙΚ.DURASIL 811 SANDGRAU 310ML',
            'notes' => 'Σιλικόνη λευκή',
            'image_url' => 'ΣΙΛΙΚ. DURASIL 811 SANDGRAU 310ML.jpg'
        ]);

        Product::create([
            'detsis_code' => '0306-01',
            'product_code'=> '3-0121',
            'product_name'=> 'ΤΑΠΑ ΛΕΥΚΗ 111',
            'notes' => 'Τάπα για τσιμεντόβιδα',
            'image_url' => 'ΤΑΠΑ ΛΕΥΚΗ 111.jpg'
        ]);

        Product::create([
            'detsis_code' => '0306-02',
            'product_code'=> '3-0650',
            'product_name'=> 'ΤΑΠΑ ΜΑΥΡΗ 113',
            'notes' => 'Τάπα για τσιμεντόβιδα',
            'image_url' => 'ΤΑΠΑ ΜΑΥΡΗ 113.jpg'
        ]);

        Product::create([
            'detsis_code' => '0401-01',
            'product_code'=> '6-0002',
            'product_name'=> 'ΧΑΡΤΟΤΑΙΝΙΑ 25',
            'notes' => 'Χαρτοταινία 25mm',
            'image_url' => 'ΧΑΡΤΟΤΑΙΝΙΑ 25ΜΜ.jpg'
        ]);

        Product::create([
            'detsis_code' => '0201-05',
            'product_code'=> '2-0097',
            'product_name'=> 'ΣΙΛΙΚ.811-DURASIL310ML',
            'notes' => 'Σιλικόνη μαύρη',
            'image_url' => 'ΣΙΛΙΚ.811-DURASIL ΜΑΥΡΗ 310ML.jpg'
        ]);

        Product::create([
            'detsis_code' => '0306-03',
            'product_code'=> '3-0119',
            'product_name'=> 'ΤΑΠΑ ΔΙΟΡΘ.Φ10 ΛΕΥΚΗ 31',
            'notes' => 'Τάπα διορθωτική φ10',
            'image_url' => 'ΤΑΠΑ ΔΙΟΡΘ.Φ10 ΛΕΥΚΗ 31.jpg'
        ]);

        Product::create([
            'detsis_code' => '0306-04',
            'product_code'=> '3-0570',
            'product_name'=> 'ΤΑΠΑ ΔΙΟΡΘ.Φ12 ΛΕΥΚΗ 41',
            'notes' => 'Τάπα διορθωτική φ12',
            'image_url' => 'ΤΑΠΑ ΔΙΟΡΘ.Φ10 ΛΕΥΚΗ 31.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0106-01',
            'product_code'=> '5-1276',
            'product_name'=> 'ΚΥΛΙΝΔΡΟΣ Υ ΑΠΛΟΣ 43-43 ΠΟΜΟΛΟ ΔΑΚΡΥ',
            'notes' => 'Αφαλός 90mm με πομολάκι 43-43',
            'image_url' => 'ΚΥΛΙΝΔΡΟΣ Υ ΑΠΛΟΣ 43-43 ΠΟΜΟΛΟ ΔΑΚΡΥ.jpg'
        ]);
        
        Product::create([
            'detsis_code' => '0106-02',
            'product_code'=> '5-0288',
            'product_name'=> 'ΚΥΛΙΝΔΡΟΣ Υ ΑΠΛΟΣ 43-52 ΠΟΜΟΛΟ ΔΑΚΡΥ',
            'notes' => 'Αφαλός 90mm με πομολάκι 43-52',
            'image_url' => 'ΚΥΛΙΝΔΡΟΣ Υ ΑΠΛΟΣ 43-43 ΠΟΜΟΛΟ ΔΑΚΡΥ.jpg'
        ]);

        Product::create([
            'detsis_code' => '0106-03',
            'product_code'=> '5-0284',
            'product_name'=> 'ΚΥΛΙΝΔΡΟΣ Υ ΑΣΦ 40-50',
            'notes' => 'Αφαλός ασφαλείας διπλής ενέργειας 40-50',
            'image_url' => 'ΚΥΛΙΝΔΡΟΣ Υ ΑΣΦ 40-50.jpg'
        ]);

        Product::create([
            'detsis_code' => '0106-04',
            'product_code'=> '5-0337',
            'product_name'=> 'ΕΞΤΡΑ ΚΛΕΙΔΙ ΓΙΑ ΚΥΛΙΝΔΡΟ',
            'notes' => '1 επιπλέον κλειδί',
            'image_url' => 'extra κλειδί.jpg'
        ]);
        
    }
}
