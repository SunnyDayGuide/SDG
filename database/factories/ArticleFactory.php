<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
	$title = $faker->sentence;

    return [
        'market_id' => $faker->numberBetween($min = 1, $max = 11),
        'article_type_id' => function () {
            return factory('App\ArticleType')->create()->id;
        },
        'title' => $title,
        'author' => $faker->name,
        'image' => $faker->imageUrl($width = 640, $height = 480, 'cats'),
        'content' => $faker->paragraph,
        'excerpt' => $faker->sentence,
        'rating' => 0,
        'featured' => $faker->boolean($chanceOfGettingTrue = 40),
        'active' => true,
        'slug' => str_slug($title),
        'published_at' => $faker->dateTime($max = 'now', $timezone = null)
    ];
});

$factory->define(App\ArticleType::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'order' => $faker->numberBetween($min = 1, $max = 3)
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
