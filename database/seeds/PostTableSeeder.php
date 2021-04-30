<?php

use App\Model\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach (range(1,100) as $index){
            $title = $faker->unique()->sentence;
            Post::create([
                'user_id' => rand(1, 20),
                'category_id' => rand(1, 5),
                'title' => $title,
                'slug' => Str::slug($title),
                'description' => $faker->paragraph,
                'image' => $faker->imageUrl(),
                'status' => rand(0, 1)

            ]);
        }
    }
}
