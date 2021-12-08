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
            $table->unsignedBigInteger('extra_shipper_id')->nullable();
            $table->string('invoice_number');
            $table->float('shipment_price');  //includes extra_price
            $table->float('extra_price')->nullable();
            $table->foreign('shipper_id')->references('id')->on('shippers')->onDelete('cascade');
            $table->foreign('extra_shipper_id')->references('id')->on('shippers')->onDelete('cascade');
            $table->timestamps();
        });

        /*
            This method is used to just add the foreign key to the invoices table, because 
            shipments table had not been created when invoices table was created.
                - invoices table is created
                    invoices  [requires foreign of order_shipment]
                - shipments table is created 
                    shipments [requires foreign of invoices]

            Thus, foreign keys cannot be inserted when creating the first table. 

        */

        Schema::table('invoices', function(Blueprint $table) {
            $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');
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
