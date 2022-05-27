<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'owner_id' => 1,
            'name' => 'Nintendo Switch',
            'image' => '/img/nintendoswitch.png',
            'category' => 'Electronics',
            'description' => "Mooie Nintendo Switch, zo goed als nieuw! Komt met 3 games: Mario Odyssey, Pokemon Legends: Arceus en The Legend of Zelda: Breath of the Wild.",
            'condition' => "As good as new",
        ]);

        DB::table('products')->insert([
            'owner_id' => 1,
            'name' => 'Playstation 4',
            'image' => '/img/ps4.png',
            'category' => 'Electronics',
            'description' => "Oude PS4 te leen! 8 jaar oud maar doet het nog perfect. Komt met Horizon: Zero Dawn.",
            'condition' => "Used",
        ]);

        DB::table('products')->insert([
            'owner_id' => 1,
            'name' => 'Ibanez Gitaar',
            'image' => '/img/gitaar.png',
            'category' => 'Music',
            'description' => "Super mooie gitaar te leen! RG857OZ model. Voor beginners of ervaren gitaarspelers.",
            'condition' => "New",
        ]);

        DB::table('products')->insert([
            'owner_id' => 1,
            'name' => 'Post Human: Survival Horror 12" Vinyl',
            'image' => '/img/bmthalbum.png',
            'category' => 'Music',
            'description' => "Het nieuwste album van Bring me the Horizon op vinyl! Voor de verzamelaars onder ons.",
            'condition' => "As good as new",
        ]);

        DB::table('products')->insert([
            'owner_id' => 2,
            'name' => 'Princess Popcorn machine',
            'image' => '/img/popcornmachine.png',
            'category' => 'Food & Nutrition',
            'description' => "Mooie, goed werkende popcorn machine. (popcorn niet inclusief)",
            'condition' => "As good as new",
        ]);

    }
}
