<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(0,2) as $index){
            $image = $faker->image(public_path('image'));
            $image = str_replace(public_path(),'',$image);
            $admin = \App\Admain::create([
                'userName' => $faker->userName,
                'email' => $faker->email,
                'image' => $image,
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            ]);
        };
    }
}
