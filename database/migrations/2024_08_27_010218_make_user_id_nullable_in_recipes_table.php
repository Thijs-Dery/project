<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUserIdNullableInRecipesTable extends Migration
{
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            // Modify the user_id column to be nullable
            $table->foreignId('user_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            // Revert the user_id column to be not nullable
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }
}
