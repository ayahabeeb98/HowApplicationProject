<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $image = $faker->image(public_path('Image'));
        $image = str_replace(public_path(),'',$image);
        foreach (range(0,20) as $index){
            \App\Category::create([
                'name' => $faker->name,
                 'image' => $image
            ]);
        }
    }
}
