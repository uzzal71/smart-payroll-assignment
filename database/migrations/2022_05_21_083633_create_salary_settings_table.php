<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalarySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('gross_salary')->default(0);
            $table->integer('basic_salary')->default(0);
            $table->integer('house_rent')->default(0);
            $table->integer('medical_allowance')->default(0);
            $table->integer('transport_allowance')->default(0);
            $table->integer('food_allowance')->default(0);
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
        Schema::dropIfExists('salary_settings');
    }
}
