<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;
use App\Models\FaqCategory;

class FaqsTableSeeder extends Seeder
{
    public function run()
    {
        $category = FaqCategory::create(['name' => 'General']);

        Faq::create([
            'question' => 'What is the purpose of this site?',
            'answer' => 'This site is used to manage and display FAQs.',
            'faq_category_id' => $category->id,  // Use the correct column name here
        ]);
    }
}

