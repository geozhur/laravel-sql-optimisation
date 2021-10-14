<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            $tags = Tag::inRandomOrder()->limit(rand(1, 3))->pluck('id')->toArray();
            $post->tags()->sync($tags);
        }
    }
}
