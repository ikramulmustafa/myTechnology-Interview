<?php

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
        $tags = Tag::all();
        $posts = Post::all();

        foreach ($posts as $post){
            if($post->id % 2 == 0){
                $post->tags()->attach($tags->first());
            }else{
                $post->tags()->attach($tags->last());

            }
        }

    }
}
