<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToFaqsTable extends Migration
{
    public function up()
    {
        // Check if the column exists before adding it
        if (!Schema::hasColumn('faqs', 'category_id')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id')->nullable()->after('answer');
                // Add foreign key if needed
                $table->foreign('category_id')->references('id')->on('faq_categories');
            });
        }
    }

    public function down()
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}


