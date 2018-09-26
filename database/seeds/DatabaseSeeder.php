<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UserSeeder::class);
//        $this->call(CategorySeeder::class);
//        $this->call(videosSeeder::class);
//        $this->call(historySeeder::class);
//        $this->call(AdminSeeder::class);
//        $this->call(favoriteSeeder::class);
//        $this->call(videosSeeder::class);
//        $this->call(SearchSeeder::class);
          $this->call(CommentsSeeder::class);

    }
}
