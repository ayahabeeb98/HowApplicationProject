<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(0,20) as $index){
            $image = $faker->image(public_path('Image'));
            $image = str_replace(public_path(),'',$image);
            $user = \App\User::create([
                'FirstName' => $faker->firstName,
                'LastName' => $faker->lastName,
                'UserName' => $faker->userName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'visaCard' => $faker->phoneNumber,
                'image' => $image,
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'interest' => $faker->title

            ]);
        };
    }
}
