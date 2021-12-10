<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Employee;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Employee::create([
            'first_name' => 'Νικόλαος',
            'surname' =>'Χωριανόπουλος',
            'father_name' =>'Γεώργιος',
            'mother_name' =>'Μαρία',
            'date_of_birth' =>'12-10-1978',
            'email' => 'naxionman@yahoo.com',
            'mobile' =>'6974757077',
            'phone2' => '22850-52388',
            'date_joined' => '23-10-2021',
            'amka' => '12107802972',
            'ama' => '4455405',
            'afm' => '121278500',
            'adt' => 'AO 450879',
            'citizenship' => 'Ελληνική',
            'contract_type' => 'Αορίστου χρόνου',
            'working_days' => '5',
            'working_hours' => '40',
            'speciality' => 'Υπάλληλος',
            'marital_status' => 'Έγγαμος',
            'children' => '2',
            'leave_days_entitled' => '5',
            'leave_days_taken' => '0',
            'notes' => '',
        ]);

        Employee::create([
            'first_name' => 'Ervis',
            'surname' =>'Gjonaj',
            'father_name' =>'Jak',
            'mother_name' =>'Arjana',
            'date_of_birth' =>'09-08-2021',
            'mobile' =>'6981080854',
            'date_joined' => '3-11-2021',
            'amka' => '09088404794',
            'ama' => '304347723',
            'afm' => '155498455',
            'adt' => 'BB3920251',
            'citizenship' => 'Αλβανική',
            'contract_type' => 'Ορισμένου χρόνου',
            'contract_expiring' => '23-12-2021',
            'working_days' => '6',
            'working_hours' => '40',
            'speciality' => 'Εργατοτεχνίτης',
            'marital_status' => 'Έγγαμος',
            'children' => '2',
            'leave_days_entitled' => '4',
            'leave_days_taken' => '0',
        ]);

        Employee::create([
            'first_name' => 'Πέτρος',
            'surname' =>'Μαράκης',
            'father_name' =>'Λεωνίδας',
            'mother_name' =>'Αλεξάνδρα',
            'date_of_birth' =>'05-12-1974',
            'date_joined' => '11-06-2021',
            'amka' => '05127404399',
            'ama' => '4281478',
            'afm' => '074757214',
            'adt' => 'Ν 595987',
            'citizenship' => 'Ελληνική',
            'contract_type' => 'Ορισμένου χρόνου',
            'contract_expiring' => '13-12-2021',
            'working_days' => '5',
            'working_hours' => '40',
            'speciality' => 'Εργατοτεχνίτης',
            'marital_status' => 'Άγαμος',
            'children' => '0',
        ]);

        Employee::create([
            'first_name' => 'Δημήτριος',
            'surname' =>'Απειρανθίτης',
            'father_name' =>'Γεώργιος',
            'mother_name' =>'Μαρία-Ζωή',
            'date_of_birth' =>'22-01-1998',
            'date_joined' => '10-04-2021',
            'date_left' => '21-05-2021',
            'amka' => '22019801590',
            'ama' => '303830574',
            'afm' => '155486561',
            'adt' => 'ΑΙ 922523',
            'citizenship' => 'Ελληνική',
            'contract_type' => 'Ορισμένου χρόνου',
            'contract_expiring' => '21-05-2021',
            'working_days' => '5',
            'working_hours' => '40',
            'speciality' => 'Εργατοτεχνίτης',
            'marital_status' => 'Άγαμος',
            'children' => '0',
        ]);

        Employee::create([
            'first_name' => 'Νικόλαος',
            'surname' =>'Βρεττός',
            'father_name' =>'Γεώργιος',
            'mother_name' =>'Ανδριάνα-Μαρία',
            'date_of_birth' =>'07-03-2021',
            'date_joined' => '01-04-2021',
            'amka' => '07030100312',
            'ama' => '302095868',
            'afm' => '155492242',
            'adt' => 'ΑΚ 458115',
            'citizenship' => 'Ελληνική',
            'contract_type' => 'Αορίστου χρόνου',
            'working_days' => '5',
            'working_hours' => '40',
            'speciality' => 'Εργατοτεχνίτης',
            'marital_status' => 'Άγαμος',
            'children' => '0',
        ]);

        Employee::create([
            'first_name' => 'Γεώργιος',
            'surname' =>'Κορρές',
            'father_name' =>'Βασίλειος',
            'mother_name' =>'Ιωάννα',
            'date_of_birth' =>'05-02-1988',
            'mobile' =>'6941410469',
            'phone2' => '2285051728',
            'date_joined' => '09-02-2021',
            'amka' => '05028803590',
            'afm' => '130687760',
            'adt' => 'ΑΝ 444569',
            'citizenship' => 'Ελληνική',
            'contract_type' => 'Αορίστου χρόνου',
            'working_days' => '5',
            'working_hours' => '40',
            'speciality' => 'Εργατοτεχνίτης',
            'marital_status' => 'Άγαμος',
            'children' => '0',
        ]);

        Employee::create([
            'first_name' => 'Στυλιανός',
            'surname' =>'Ψαρράς',
            'father_name' =>'Ιάκωβος',
            'mother_name' =>'Σταματική',
            'date_of_birth' =>'20-09-1973',
            'date_joined' => '01-06-2001',
            'amka' => '20097300436',
            'ama' => '4281737',
            'afm' => '07448192',
            'citizenship' => 'Ελληνική',
            'contract_type' => 'Αορίστου χρόνου',
            'working_days' => '5',
            'working_hours' => '40',
            'speciality' => 'Εργατοτεχνίτης',
            'marital_status' => 'Έγγαμος',
            'children' => '2',
        ]);

        Employee::create([
            'first_name' => 'Νικόλαος',
            'surname' =>'Κατρακάζας',
            'father_name' =>'Μιχαήλ',
            'mother_name' =>'Παρασκευή',
            'date_of_birth' =>'30-08-1975',
            'mobile' =>'6978546775',
            'date_joined' => '11-12-2006',
            'amka' => '30087500937',
            'ama' => '3386043',
            'afm' => '061363691',
            'citizenship' => 'Ελληνική',
            'contract_type' => 'Αορίστου χρόνου',
            'working_days' => '5',
            'working_hours' => '40',
            'speciality' => 'Εργατοτεχνίτης',
            'marital_status' => 'Έγγαμος',
            'children' => '2',
        ]);

        Employee::create([
            'first_name' => 'Σταμάτιος',
            'surname' =>'Γερονικολόπουλος',
            'father_name' =>'Ιωάννης',
            'mother_name' =>'Σοφία',
            'date_of_birth' =>'28-02-1988',
            'mobile' =>'6973438549',
            'date_joined' => '22-09-2008',
            'amka' => '28028801851',
            'ama' => '8319053',
            'afm' => '130685047',
            'citizenship' => 'Ελληνική',
            'contract_type' => 'Αορίστου χρόνου',
            'working_days' => '5',
            'working_hours' => '40',
            'speciality' => 'Εργατοτεχνίτης',
            'marital_status' => 'Άγαμος',
            'children' => '0',
        ]);
        
        Employee::create([
            'first_name' => 'Mihail',
            'surname' =>'Bani',
            'father_name' =>'Lohinda',
            'mother_name' =>'Aferdita',
            'date_of_birth' =>'07-08-1985',
            'mobile' =>'6984993515',
            'date_joined' => '07-08-2009',
            'amka' => '07088500439',
            'ama' => '7868880',
            'afm' => '130662833',
            'citizenship' => 'Αλβανική',
            'contract_type' => 'Αορίστου χρόνου',
            'working_days' => '5',
            'working_hours' => '40',
            'speciality' => 'Εργατοτεχνίτης',
            'marital_status' => 'Άγαμος',
            'children' => '0',
        ]);
    }
}
