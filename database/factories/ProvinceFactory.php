<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Language;
use App\Province;
use Faker\Generator as Faker;


$factory->define(Province::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'population' => rand(0,999999),
    ];
});
