<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
	$title = $faker->sentence;

    return [
        'market_id' => $faker->numberBetween($min = 1, $max = 11),
        'article_type_id' => $faker->numberBetween($min = 1, $max = 3),
        'title' => $faker->sentence,
        'author' => $faker->name,
        'content' => '<p>'.$faker->paragraph.'</p>',
        'excerpt' => $faker->sentence,
        'rating' => 0,
        'featured' => $faker->boolean($chanceOfGettingTrue = 40),
        'status' => $faker->boolean($chanceOfGettingTrue = 70),
        'publish_date' => $faker->dateTime($max = 'now', $timezone = null)
    ];
});

$factory->state(App\Article::class, 'tripIdea', [
    'article_type_id' => 1,
]);

$factory->state(App\Article::class, 'visitorInfo', [
    'article_type_id' => 2,
]);

$factory->state(App\Article::class, 'advSpotlight', [
    'article_type_id' => 3,
]);
