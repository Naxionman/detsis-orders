<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fuel_type');
            $table->date('insurance_date')->nullable();
            $table->integer('insurance_duration')->nullable();
            $table->date('service_date')->nullable();
            $table->date('kteo')->nullable();
            
            //Τι άλλο πρέπει να διατηρούμε ως πληροφορίες οχήματος
            
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
        Schema::dropIfExists('vehicles');
    }
}
