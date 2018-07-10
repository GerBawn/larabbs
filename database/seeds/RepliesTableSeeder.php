<?php

use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = User::pluck('id')->toArray();
        $topicIds = Topic::pluck('id')->toArray();
        $faker = app(Faker\Generator::class);

        $replies = factory(Reply::class)
            ->times(1000)
            ->make()
            ->each(
                function ($reply, $index) use ($faker, $userIds, $topicIds) {
                    $reply->user_id = $faker->randomElement($userIds);
                    $reply->topic_id = $faker->randomElement($topicIds);
                }
            )->toArray();

        Reply::insert($replies);
    }
}
