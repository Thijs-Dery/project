<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            FaqCategorySeeder::class,
            FaqsTableSeeder::class,
        ]);
    }
}



