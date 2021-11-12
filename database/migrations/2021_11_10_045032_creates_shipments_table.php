<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesShipmentsTable extends Migration
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
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('shipper_id');
            $table->string('invoice_number');

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('shipper_id')->references('id')->on('shippers')->onDelete('cascade');
            $table->timestamps();
        });

        /*
            This method is used to just add the foreign key to the orders table, because 
            order_shipments table had not been created when orders table was created.
                - orders table is created
                    orders  [requires foreign of order_shipment]
                - order_shipments table is created 
                    order_shipments [requires foreign of orders]

            Thus, foreign keys cannot be inserted when creating the first table. 

        */

        Schema::table('orders', function(Blueprint $table) {
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
