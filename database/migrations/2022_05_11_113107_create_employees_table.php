<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
            $table->string('employee_id_card');
            $table->string('employee_punch_card');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('nid')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('religion')->nullable();
            $table->string('sex')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('employee_status');
            $table->date('joining_date')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('emergency_contact_person_name')->nullable();
            $table->string('emergency_contact_person_number')->nullable();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('designation_id');
            $table->unsignedBigInteger('schedule_id');
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->enum('tax_status', ['1', '0'])->default(0);
            $table->enum('provident_found_status', ['1', '0'])->default(0);
            $table->enum('transport_allowance_status', ['1', '0'])->default(0);
            $table->enum('commission_status', ['1', '0'])->default(0);
            $table->enum('salary_withdraw', ['cash', 'bank'])->default('cash');
            $table->string('employee_photo')->nullable()->default('default.png');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->foreign('schedule_id')->references('id')->on('schedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
