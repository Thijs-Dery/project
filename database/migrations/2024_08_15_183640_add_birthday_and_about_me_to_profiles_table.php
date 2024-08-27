<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBirthdayAndAboutMeToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('profiles', 'birthday')) {
                $table->date('birthday')->nullable();
            }

            if (!Schema::hasColumn('profiles', 'about_me')) {
                $table->text('about_me')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (Schema::hasColumn('profiles', 'birthday')) {
                $table->dropColumn('birthday');
            }

            if (Schema::hasColumn('profiles', 'about_me')) {
                $table->dropColumn('about_me');
            }
        });
    }
}
