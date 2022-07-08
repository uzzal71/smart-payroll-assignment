<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_full_name');
            $table->string('company_short_name');
            $table->string('owner_name');
            $table->string('phone');
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('address');
            $table->string('logo')->nullable();
            $table->string('signature')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
