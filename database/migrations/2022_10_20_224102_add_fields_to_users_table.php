<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('image', 250)->nullable();
            $table->mediumText('about')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('twitter_url', 120)->nullable();
            $table->string('facebook_url', 120)->nullable();
            $table->string('instagram_url', 120)->nullable();
            $table->string('linkedin_url', 120)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('about');
            $table->dropColumn('phone');
            $table->dropColumn('twitter_url');
            $table->dropColumn('facebook_url');
            $table->dropColumn('instagram_url');
            $table->dropColumn('linkedin_url');
        });
    }
}
