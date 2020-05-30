<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Quote;
use Faker\Generator as Faker;

$factory->define(Quote::class, function (Faker $faker) {
    return [
            'from_city' => $faker->city,
            'to_city' => $faker->city,
            'description' => $faker->text(50),
            'length' => $faker->randomFloat(2),
            'width' => $faker->randomFloat(2),
            'height' => $faker->randomFloat(2),
            'weight' => $faker->randomFloat(2),
            'eta' => $faker->randomDigit,
            'cost' => $faker->numberBetween(1000,10000),
            'advance' => $faker->numberBetween(100,1000),
            'tax_id' => '1',
    ];
});
