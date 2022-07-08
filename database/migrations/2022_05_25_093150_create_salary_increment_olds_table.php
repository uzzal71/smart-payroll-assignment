<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryIncrementOldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_increment_olds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->double('gross_salary', 10, 2)->default(0.00);
            $table->double('basic_salary', 10, 2)->default(0.00);
            $table->double('house_rent', 10, 2)->default(0.00);
            $table->double('medical_allowance', 10, 0)->default(0.00);
            $table->double('transport_allowance', 10, 2)->default(0.00);
            $table->double('food_allowance', 10, 2)->default(0.00);
            $table->string('increment_month');
            $table->year('increment_year');
            $table->date('effective_date');
            $table->string('remarks');
            $table->enum('status', ['active', 'inactive']);
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
        Schema::dropIfExists('salary_increment_olds');
    }
}
