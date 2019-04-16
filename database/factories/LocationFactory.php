<?php

use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker) {
    return [
        'formatted_address' => $faker->address,
        'street_number' => $faker->buildingNumber,
        'route' => $faker->streetName,
        'address_line_1' => $faker->address,
        'address_line_2' => $faker->optional()->secondaryAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'postal_code' => $faker->postcode,
        'country' => 'United States',
        'latitude' => $faker->latitude($min = 25, $max = 40),
        'longitude' => $faker->longitude($min = 70, $max = 90),
        'telephone' => $faker->phoneNumber,
        'advertiser_id' => $faker->numberBetween($min = 1, $max = 100)
    ];
});
