<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use Faker\Generator as Faker;


$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'population' => rand(0,999999),
        'time_zone' => "2",
        'area_code' => rand(1,199),
        'province_id' => rand(1,20),
    ];
});
