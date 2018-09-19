<?php

use Illuminate\Database\Seeder;

class videosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $categories = \App\Category::all()->pluck('id')->toArray();
        $image = $faker->image(public_path('Image'));
        $image = str_replace(public_path(),'',$image);
        foreach (range(0,20) as $index){
            \App\Video::create([
               'name' => $faker->name,
               'image' => $image,
                'url' => $faker->url,
                'video_id' => $faker->uuid,
                'category_id' => $faker->randomElement($categories)
            ]);
        }
    }
}
