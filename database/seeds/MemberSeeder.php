<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
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
            DB::table('members')->insert([
                'name' => $faker->name,
                'age' => $faker->randomElement([17,18,19,20,21,22]),
                'address' => $faker->address,
                'telephone' => $faker->phoneNumber,
                'lc_number' => $faker->creditCardNumber,
                'date_of_joined' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'is_active' => 1,
            ]);
        }
    }
}
