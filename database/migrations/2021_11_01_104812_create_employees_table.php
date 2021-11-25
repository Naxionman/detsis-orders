<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('surname');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone2')->nullable();
            $table->date('date_joined')->nullable();
            $table->date('date_left')->nullable();
            $table->string('amka')->nullable();
            $table->string('ama')->nullable();
            $table->string('afm')->nullable();
            $table->string('adt')->nullable();
            $table->string('citinzenship')->nullable();
            $table->string('contract_type')->nullable();
            $table->date('contract_expiring')->nullable();
            $table->integer('working_days')->nullable();
            $table->integer('working_hours')->nullable();
            $table->string('speciality')->nullable();
            $table->string('marital_status')->nullable();
            $table->integer('children')->nullable();
            $table->integer('leave_days')->nullable();
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
