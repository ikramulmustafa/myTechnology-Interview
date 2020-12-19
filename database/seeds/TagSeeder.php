<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 4) as $index) {
            $arr[] = ['name' => $faker->slug,
                'slug' => $faker->slug,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()

            ];
        }
        Tag::insert($arr);
    }
}
