<?php

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            $arr[] = ['title' => $faker->slug,
                'slug' => $faker->slug,
                'content' => $faker->sentence(50),
                'user_id' => \App\Models\Role::where('slug','user')->first()->user->id,
                'featured_image'=>$faker->image('public/images',640,480, null, false),
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
            ];
        }
        Post::insert($arr);
    }
}
