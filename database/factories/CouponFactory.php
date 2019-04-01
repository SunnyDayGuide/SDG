<?php

use App\Coupon;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'market_id' => 1,
        // 'market_id' => $faker->numberBetween($min = 1, $max = 11),
        'category_id' => $faker->numberBetween($min = 1, $max = 4),
        'offer' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'suboffer' => $faker->sentence($nbWords = 8, $variableNbWords = true),
        'disclaimer' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'promo_code' => $faker->bothify('##??#?'),
        'barcode' => $faker->randomNumber(),
        'barcode_type' => 'C128',
        'logo_id' => $faker->numberBetween($min = 1, $max = 20),
        'active' => $faker->boolean($chanceOfGettingTrue = 90),
    ];
});

