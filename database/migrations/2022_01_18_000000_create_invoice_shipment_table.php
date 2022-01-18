<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceShipmentTable extends Migration {
    /**
     * Joint (Pivot) Table for Many To Many relationship of shipments and invoices
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_shipment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('shipment_id');

            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('shipment_id')->references('id')->on('shipments');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_shipment');
    }
}
