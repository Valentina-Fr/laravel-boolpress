<?php

use App\User;
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
        for($i = 0; $i < 50; $i++) {
            $post = new Post();
            $post->title = $faker->text(50);
            $post->article = $faker->paragraphs(3, true);
            $post->user_id = Arr::random($user_ids);
            $post->save();
        }
    }
}
