<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('salary_date'); //Ημερομηνία πληρωμής μισθού
            $table->string('salary_month'); // (salary_month, salary_year)These are kept as string but are input through dropdown list
            $table->string('salary_year');
            $table->float('daily_wages')->nullable(); //Νόμιμο ημερομίσθιο
            $table->float('3_year_benefit')->nullable(); //Επίδομα τριετίας
            $table->float('marriage_benefit')->nullable(); //Επίδομα γάμου
            $table->float('insurance_deduction_daily')->nullable(); //Ασφαλιστικές κρατήσεις εργαζόμενου νόμιμου ημερομισθίου
            $table->float('agreed_daily_wages_sum')->nullable(); //Σύνολο συμφωνηθέντος ημερομισθίου
            $table->float('hourly_wage')->nullable(); // Ωρομίσθιο
            $table->float('gross_earnings'); //Κανονικές αποδοχές
            $table->float('insurance_deduction_monthly')->nullable(); //Ασφαλιστικές κρατήσεις εργαζομένου
            $table->string('insurance_deduction_type'); //π.χ 102 - ΙΚΑ ΜΙΚΤΑ - ΕΤΑΜ ΜΕ ΕΠΑΓΓΕΛΑΜΤΙΚΟ ΚΙΝΔΥΝΟ
            $table->float('payroll_tax_deduction')->nullable(); // Κρατήσεις Φόρου Μισθωτών Υπηρεσιών
            $table->float('advance')->default('0.00');
            $table->float('net_salary'); //Πληρωτέες αποδοχές

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
}
