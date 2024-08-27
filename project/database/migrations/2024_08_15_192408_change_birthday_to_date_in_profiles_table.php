<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBirthdayToDateInProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->date('birthday')->nullable()->change(); 
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('birthday', 255)->nullable()->change(); 
        });
    }
}
