<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shipment_id')->nullable();
            $table->unsignedBigInteger('supplier_id');
            $table->string('invoice_type');
            $table->date('invoice_date');
            $table->string('supplier_invoice_number');
            $table->float('invoice_tax_rate')->default('24.00');
            $table->float('extra_charges')->default('0.00');
            $table->float('order_discount')->default('0.00');
            $table->float('invoice_total');
            $table->text('notes')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('invoices');
    }
}
