<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSchoolYearColumnToSchoolReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('school_reports', function (Blueprint $table) {
            $table->integer('school_year')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('school_reports', function (Blueprint $table) {
            $table->tinyInteger('school_year')->change();
        });
    }
}
