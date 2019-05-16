<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Comment;
use App\User;
use App\Category;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = \Faker\Factory::create();

        foreach (range(1, 50) as $index) {

            Category::create([
                'title' => $faker->jobTitle,
            ]);
        }
    }
}
