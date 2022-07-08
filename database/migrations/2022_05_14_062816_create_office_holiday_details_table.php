<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeHolidayDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_holiday_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('holiday_id');
            $table->date('holiday_date');
            $table->string('remarks');
            $table->timestamps();

            $table->foreign('holiday_id')->references('id')->on('holiday_entries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_holiday_details');
    }
}
