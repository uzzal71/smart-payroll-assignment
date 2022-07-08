<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProvidentFoundIdToEmployeesTable extends Migration
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
            $table->unsignedBigInteger('provident_funds_id')->unsigned()->nullable()->after('provident_found_status');

            // 2. Create foreign key constraints
            $table->foreign('provident_fund_id')->references('id')->on('provident_funds');
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
            $table->dropForeign(['provident_fund_id']);

            // 2. Drop the column
            $table->dropColumn('provident_fund_id');
        });
    }
}
