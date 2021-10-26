<?php

use App\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user_ids = User::pluck('id')->toArray();
        $category_ids = Category::pluck('id')->toArray();
        for ($i = 0; $i < 50; $i++) {
            $post = new Post();
            $post->title = $faker->text(50);
            $post->article = $faker->paragraphs(3, true);
            $post->user_id = Arr::random($user_ids);
            $post->category_id = Arr::random($category_ids);
            $post->save();
        }
    }
}
