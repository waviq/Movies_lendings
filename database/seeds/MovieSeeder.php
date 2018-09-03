<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(0,10) as $i){
            DB::table('movies')->insert([
                'title' => $faker->word,
                'genre' => $faker->randomElement(['Action', 'Comedy','Anime', 'Drama']),
                'release_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
            ]);
        }
    }
}
