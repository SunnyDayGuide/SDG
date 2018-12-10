<?php

use App\Freemail;
use Faker\Generator as Faker;

$factory->define(Freemail::class, function (Faker $faker) {
    return [
        'market_id' => $faker->numberBetween($min = 1, $max = 11),
        'client' => $faker->company,
        'contact_name' => $faker->name,
        'contact_email' => $faker->safeEmail,
        'contact_phone' => $faker->phoneNumber,
        'freemail_email' => $faker->safeEmail,
        'notes' => $faker->optional()->sentence,
        'active' => $faker->boolean($chanceOfGettingTrue = 80),
        'consent' => false,
        'freemail_type_id' => $faker->numberBetween($min = 1, $max = 4),
        'user_id' => $faker->numberBetween($min = 14, $max = 25),
    ];
});

// $factory->state(Freemail::class, 'consented', [
//     'consent' => true,
//     'consent_date' => $faker->dateTimeThisMonth($max = 'now', $timezone = null)
// ]);
