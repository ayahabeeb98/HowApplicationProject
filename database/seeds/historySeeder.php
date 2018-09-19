<?php

use Illuminate\Database\Seeder;

class historySeeder extends Seeder
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
        $videos = \App\Video::all()->pluck('id')->toArray();
        foreach (range(0,20) as $index){
            \App\History::create([
                'user_id' => $faker->randomElement($users),
                'video_id' => $faker->randomElement($videos)
            ]);
        }
    }
}
