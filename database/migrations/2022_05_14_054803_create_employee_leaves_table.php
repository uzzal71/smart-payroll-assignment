<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('leave_id');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('leave_days')->default(0);
            $table->string('leave_month');
            $table->year('leave_year');
            $table->text('remarks');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();

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
        Schema::dropIfExists('employee_leaves');
    }
}
