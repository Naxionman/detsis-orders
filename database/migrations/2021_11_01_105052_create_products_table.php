<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('detsis_code')->nullable();
            $table->unsignedBigInteger('last_supplier')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_name')->nullable();
            $table->integer('stock_level')->nullable();
            $table->integer('min_level')->nullable();
            $table->string('notes')->nullable();
            $table->string('image_url', 2083)->nullable();
            $table->foreign('last_supplier')->references('id')->on('suppliers')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
