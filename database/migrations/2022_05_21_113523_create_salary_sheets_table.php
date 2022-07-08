<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalarySheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_sheets', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('salary_month');
            $table->year('salary_year');
            $table->string('employee_name');
            $table->string('designation');
            $table->string('department');
            $table->date('joining_date')->nullable();
            $table->double('gross_salary', 10, 2)->nullable()->default(0.00);
            $table->double('basic_salary', 10, 2)->nullable()->default(0.00);
            $table->double('house_allowance', 10, 2)->nullable()->default(0.00);
            $table->double('medical_allowance', 10, 2)->nullable()->default(0.00);
            $table->double('transport_allowance', 10, 2)->nullable()->default(0.00);
            $table->double('food_allowance', 10, 2)->nullable()->default(0.00);
            $table->integer('number_of_days')->nullable()->default(0);
            $table->integer('weekend')->nullable()->default(0);
            $table->integer('holiday')->nullable()->default(0);
            $table->integer('need_to_work')->nullable()->default(0);
            $table->integer('present')->nullable()->default(0);
            $table->integer('late')->nullable()->default(0);
            $table->integer('absent')->nullable()->default(0);
            $table->integer('unpaid_leave')->nullable()->default(0);
            $table->integer('paid_leave')->nullable()->default(0);
            $table->integer('need_to_pay')->nullable()->default(0);
            $table->double('late_deduction', 10, 2)->nullable()->default(0.00);
            $table->double('absent_deduction', 10, 2)->nullable()->default(0.00);
            $table->double('tax_deduction', 10, 2)->nullable()->default(0.00);
            $table->double('provident_fund_deduction', 10, 2)->nullable()->default(0.00);
            $table->double('advance_salary_deduction', 10, 2)->nullable()->default(0.00);
            $table->double('others_deduction', 10, 2)->nullable()->default(0.00);
            $table->double('stamp_deduction', 10, 2)->nullable()->default(0.00);
            $table->double('total_deduction', 10, 2)->nullable()->default(0.00);
            $table->double('commission_addition', 10, 2)->nullable()->default(0.00);
            $table->double('transport_bill_addition', 10, 2)->nullable()->default(0.00);
            $table->double('paid_leave_addition', 10, 2)->nullable()->default(0.00);
            $table->double('overtime_addition', 10, 2)->nullable()->default(0.00);
            $table->double('others_addition', 10, 2)->nullable()->default(0.00);
            $table->double('festival_bonus_addition', 10, 2)->nullable()->default(0.00);
            $table->double('total_addition', 10, 2)->nullable()->default(0.00);
            $table->double('salary_earn', 10, 2)->nullable()->default(0.00);
            $table->double('net_salary')->nullable()->default(0.00);
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
        Schema::dropIfExists('salary_sheets');
    }
}
