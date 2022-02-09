<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constants', function (Blueprint $table) {
            $table->id();
            $table->float('Επίδομα τριετίας')->default('1.48');
            $table->float('102 - IKA MIKTA - ETAM ΜΕ ΕΠΑΓΓΕΛΜΑΤΙΚΟ ΚΙΝΔΥΝΟ');
            $table->float('Κρατήσεις ΦΜΥ')->deafult('56.79');
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
        Schema::dropIfExists('constants');
    }
}
