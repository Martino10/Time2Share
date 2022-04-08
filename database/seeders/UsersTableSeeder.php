<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "MartinK",
            'email' => "martin.krikke10@gmail.com",
            'password' => bcrypt("Kraakmanisin"),
            'address' => "Beatrixplantsoen 6",
            'place' => "Woubrugge",
            'birthday' => "2000-4-19",
            'picture' => "/img/martin.png",
            'phonenumber' => "0612597207",
            'rating' => 4.2,
        ]);

        DB::table('users')->insert([
            'name' => "JulianPoelsma",
            'email' => "julianpoelsma@gmail.com",
            'password' => bcrypt("opzichwachtwoord"),
            'address' => "Hildebrandpad 113",
            'place' => "Leiden",
            'birthday' => "2000-8-25",
            'picture' => "/img/julian.png",
            'rating' => 3.6,
        ]);

    }
}
