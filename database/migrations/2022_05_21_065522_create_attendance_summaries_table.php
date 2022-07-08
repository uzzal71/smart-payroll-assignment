<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('attendance_month');
            $table->year('attendance_year');
            $table->integer('number_of_days')->default(0);
            $table->integer('weekend')->default(0);
            $table->integer('holiday')->default(0);
            $table->integer('need_to_work')->default(0);
            $table->integer('present')->default(0);
            $table->integer('late')->default(0);
            $table->integer('absent')->default(0);
            $table->integer('unpaid_leave')->default(0);
            $table->integer('paid_leave')->default(0);
            $table->integer('need_to_pay')->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('attendance_summaries');
    }
}
