<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchEmployeeTable extends Migration
{
    /**
     * The Joint table of Dispatches and Employees
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_employee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dispatch_id');
            $table->unsignedBigInteger('employee_id');

            $table->foreign('dispatch_id')->references('id')->on('dispatches');
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispatch_employee');
    }
}
