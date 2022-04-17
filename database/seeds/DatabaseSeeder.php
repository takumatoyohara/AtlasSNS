<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            TweetsTableSeeder::class,
            CommentsTableSeeder::class,
            FavoritesTableSeeder::class,
            FollowersTableSeeder::class,

        // $this->call(UsersTableSeeder::class);
        ]);
    }
}
