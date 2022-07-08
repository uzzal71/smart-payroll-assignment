<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLeaveDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leave_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_leave_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('leave_id');
            $table->date('leave_date');
            $table->text('remarks');
            $table->timestamps();

            $table->foreign('employee_leave_id')->references('id')->on('employee_leaves');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('leave_id')->references('id')->on('leaves');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_leave_details');
    }
}
