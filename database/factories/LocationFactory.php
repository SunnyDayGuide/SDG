<?php

use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker) {
    return [
        'formatted_address' => $faker->address,
        'street_number' => $faker->buildingNumber,
        'route' => $faker->streetName,
        'address_line_1' => $faker->address,
        'address_line_2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'postal_code' => $faker->postcode,
        'country' => 'United States',
        'latitude' => $faker->latitude($min = -90, $max = 90),
        'longitude' => $faker->longitude($min = -180, $max = 180),
        'telephone' => $faker->phoneNumber,
        'advertiser_id' => $faker->numberBetween($min = 1, $max = 100)
    ];
});
