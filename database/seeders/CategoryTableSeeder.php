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
        $categories = ["Boeken", "Elektronica", "Speelgoed", "Sport", "Kleding", "Voeding", "School & Werk", "Huishouden", "Voertuig", "Tuin", "Kunst", "Huisdier", "Reizen", "Muziek"];
        
        foreach($categories as $category) {
            DB::table('category')->insert([
                'category' => $category
            ]);
        }
    }
}
