<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run()
    {
        Faq::create([
            'faq_category_id' => 1, 
            'question' => 'What is your return policy?', 
            'answer' => 'Our return policy is ...'
        ]);

        Faq::create([
            'faq_category_id' => 2, 
            'question' => 'How do I get a refund?', 
            'answer' => 'To get a refund ...'
        ]);
    }
}

