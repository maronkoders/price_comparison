<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ward;
use Faker\Generator as Faker;


$factory->define(Ward::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'city_id' => rand(1,25),
    ];
});
