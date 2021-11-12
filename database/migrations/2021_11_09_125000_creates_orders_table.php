<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->date('arrival_date')->nullable();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('shipment_id')->nullable();
            $table->string('order_invoice_number')->nullable();
            $table->float('order_discount')->nullable();
            $table->float('order_price')->nullable(); 
            $table->boolean('pending')->default(1);
            $table->string('notes')->nullable();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            //$table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');
            $table->timestamps();

            /*
                Just because it is impossible to ALTER TABLE for a table that has not been 
                created through a migration (in this case it is the order_shipment table)
                we need to add the commented-out line to the migration of create_order_shipments_table

            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
