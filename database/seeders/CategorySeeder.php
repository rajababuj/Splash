<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Mens Fashion'],
            ['name' => 'Phones & Tablets'],
            ['name' => 'Children products'],
            ['name' => 'Electronics'],
            ['name' => 'Home'],
            ['name' => 'Beauty & Health'],
            ['name' => 'Food'],
            ['name' => 'Equipment'],
            ['name' => 'Services'],


        ];

        DB::table('categories')->insert($categories);
    
    }
}
