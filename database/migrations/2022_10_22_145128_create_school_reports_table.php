<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->tinyInteger('school_year');
            $table->integer('school_level_id');
            $table->integer('school_grade_id');
            $table->timestamps('');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_reports');
    }
}
