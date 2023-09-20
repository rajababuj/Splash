<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [
            ['name' => 'Apple', 'category_id' => 1],
            ['name' => 'Samsung', 'category_id' => 1],
            ['name' => 'iPad (Apple)', 'category_id' => 2],
        ];

        DB::table('subcategories')->insert($subcategories);
    }
}
