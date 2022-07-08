<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxIdToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
             // 1. Create new column
            // You probably want to make the new column nullable
            $table->unsignedBigInteger('tax_id')->unsigned()->nullable()->after('tax_status');

            // 2. Create foreign key constraints
            $table->foreign('tax_id')->references('id')->on('taxes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            // 1. Drop foreign key constraints
            $table->dropForeign(['tax_id']);

            // 2. Drop the column
            $table->dropColumn('tax_id');
        });
    }
}
