<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqCategory;

class FaqCategorySeeder extends Seeder
{
    public function run()
    {
        FaqCategory::create(['name' => 'General']);
        FaqCategory::create(['name' => 'Billing']);
        FaqCategory::create(['name' => 'Technical Support']);
    }
}

