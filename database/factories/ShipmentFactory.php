<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Agency;
use App\User;
use App\Shipment;
use Faker\Generator as Faker;

$factory->define(Shipment::class, function (Faker $faker) {
    return [
        'receiver_name' => $faker->name,
        'receiver_company' => $faker->company,
        'receiver_gst' => $faker->numerify('GST#######'),
        'receiver_phone' => $faker->phoneNumber,
        'receiver_secondary_phone' => $faker->phoneNumber,
        'receiver_email' => $faker->email,
        'receiver_state' => $faker->state,
        'receiver_address' => $faker->address,
        'receiver_pincode' => $faker->postcode,
  
        'customer_id' => function() {
            return User::all()->random();
        }
    ];
});