<?php

use App\Models\Category;
use App\Models\User;
use App\Topic;
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
        $userIds = User::pluck('id')->toArray();

        $categoryIds = Category::pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)
            ->times(100)
            ->make()
            ->each(
                function ($topic, $index) use ($userIds, $categoryIds, $faker) {
                    $topic->user_id = $faker->randomElement($userIds);

                    $topic->category_id = $faker->randomElement($categoryIds);
                }
            );

        Topic::insert($topics->toArray());
    }
}
