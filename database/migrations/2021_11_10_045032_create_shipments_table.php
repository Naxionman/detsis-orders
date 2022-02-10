<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->date('shipping_date');
            $table->unsignedBigInteger('shipper_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('extra_shipper_id')->nullable();
            $table->string('shipment_invoice_number')->nullable();
            $table->float('shipment_price')->nullable(); 
            $table->float('extra_price')->nullable();
            $table->foreign('shipper_id')->references('id')->on('shippers')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('extra_shipper_id')->references('id')->on('shippers')->onDelete('cascade');
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
        Schema::dropIfExists('shipments');
    }
}
