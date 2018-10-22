<?php

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
	$name = $faker->name;

    return [
        'name' => $name,
        'slug' => str_slug($name)
    ];
});
