<?php

use Illuminate\Database\Seeder;

class SearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $users = \App\User::all()->pluck('id')->toArray();
        foreach (range(0,20) as $index){
            \App\Search::create([
                'user_id' => $faker->randomElement($users),
                'content' => $faker->title
            ]);
        }
    }
}
