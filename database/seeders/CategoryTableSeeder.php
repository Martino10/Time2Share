<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["Literature", "Electronics", "Toys", "Sport", "Clothing", "Food & Nutrition", "School & Work", "Household", "Vehicles", "Gardening", "Art", "Pet", "Travel", "Music"];
        
        foreach($categories as $category) {
            DB::table('category')->insert([
                'category' => $category
            ]);
        }
    }
}
