<?php

use Illuminate\Database\Seeder;
use App\Model\Post;
use App\Model\Tag;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allPosts = Post::all();
        $allTags = Tag::all();

        foreach($allPosts as $post) {
            $tags = Tag::inRandomOrder()->limit(rand(0, $allTags->count()))->get(); //prendo un numero casuale di tags 
            $post->tags()->attach($tags);
        }
    }
}
