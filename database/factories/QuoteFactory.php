<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Quote;
use Faker\Generator as Faker;

$factory->define(Quote::class, function (Faker $faker) {
    return [
            'from' => $faker->city,
            'to' => $faker->city,
            'description' => $faker->text(50),
            'size' => $faker->randomFloat(2),
            'weight' => $faker->randomFloat(2),
            'eta' => $faker->randomDigit,
            'rate' => $faker->numberBetween(1000,10000),
            'advance' => $faker->numberBetween(100,1000),
            'customer_id' => '1',
    ];
});
