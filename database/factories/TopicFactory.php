<?php

use App\Models\Topic;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    $sentence = $faker->sentence();
    $updatedAt = $faker->dateTimeThisMonth();
    $createdAt = $faker->dateTimeThisMonth($updatedAt);

    return [
        'title' => $sentence,
        'body' => $faker->text(),
        'excerpt' => $sentence,
        'created_at' => $createdAt,
        'updated_at' => $updatedAt,
    ];
});
