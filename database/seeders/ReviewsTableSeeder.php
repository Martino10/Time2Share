<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'user_id' => 1,
            'review_rating' => 4.2,
            'reviewer_id' => 2,
            'review_text' => "Super betrouwbare jongen! Goeie producten te leen.",
        ]);

        DB::table('reviews')->insert([
            'user_id' => 2,
            'review_rating' => 3.0,
            'reviewer_id' => 1,
            'review_text' => "Ja mooie goos, vraagt alleen wel telkens of ik een halve gram in wil leggen.",
        ]);
    }
}
