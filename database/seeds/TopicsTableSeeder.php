<?php

use App\Topic;
use App\Post;
use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $topic = Topic::create([
                'user_id' => $faker->unique()->numberBetween($min = 1, $max = 10),
                //$faker->randomElement(App\User::pluck('id', 'id')->toArray())
                'title' => $faker->sentence,
                'body'  => $faker->paragraph,
            ]);

            // fake posts for topic
            for ($j = 0; $j < $faker->numberBetween($min = 0, $max = 10); $j++) {
                Post::create([
                    'topic_id' => $topic->id,
                    'user_id' => $faker->numberBetween($min = 1, $max = 10),
                    'body' => $faker->paragraph,
                ]);
            }

        }
    }
}
