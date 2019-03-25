<?php

use Faker\Generator as Faker;

$factory->define(App\Advertiser::class, function (Faker $faker) {
    return [
        'market_id' => $faker->numberBetween($min = 1, $max = 11),
        'name' => $faker->company,
        'write_up' => '<p>'. $faker->realText($maxNbChars = 400, $indexSize = 2). '</p>',
        'toll_free' => $faker->tollFreePhoneNumber,
        'website_url' => $faker->optional()->url,
        'ticket_url' => $faker->optional()->url,
        'booking_url' => $faker->optional()->url,
        'reservation_url' => $faker->optional()->url,
        'facebook' => $faker->optional()->url,
        'twitter' => $faker->optional()->url,
        'instagram' => $faker->optional()->url,
        'youtube' => $faker->optional()->url,
        'pinterest' => $faker->optional()->url,
        'active' => $faker->boolean($chanceOfGettingTrue = 90),
        'level_id' => $faker->numberBetween($min = 1, $max = 3),
    ];
});
