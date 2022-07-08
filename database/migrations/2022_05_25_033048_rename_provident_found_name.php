<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameProvidentFoundName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('provident_funds', function (Blueprint $table) {
            $table->renameColumn('provident_found_name','provident_fund_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provident_funds', function (Blueprint $table) {
            $table->renameColumn('provident_fund_name','provident_found_name');
        });
    }
}
