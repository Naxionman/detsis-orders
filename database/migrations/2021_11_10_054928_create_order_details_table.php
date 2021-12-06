<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id');
            $table->boolean('pending')->default(1);
            $table->integer('quantity');
            $table->string('measurement_unit')->default('ΤΕΜ');
            $table->integer('items_per_package')->default('1');
            $table->float('net_value')->nullable();
            $table->float('product_discount')->default('0.00');
            $table->float('tax_rate')->default('24.00');    //We need to have this stored in case of change
            $table->float('price')->nullable(); //final price after discount and tax
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('order_details');
    }
}
