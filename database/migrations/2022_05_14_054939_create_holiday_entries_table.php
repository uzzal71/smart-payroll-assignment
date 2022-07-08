<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidayEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday_entries', function (Blueprint $table) {
            $table->id();
            $table->string('holiday_name');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('holiday_days')->default(1);
            $table->string('holiday_month');
            $table->year('holiday_year');
            $table->string('remarks');
            $table->enum('status', ['active', 'inactive']);
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
        Schema::dropIfExists('holiday_entries');
    }
}
