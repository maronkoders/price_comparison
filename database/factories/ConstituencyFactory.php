<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Constituency;
use Faker\Generator as Faker;


$factory->define(Constituency::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'province_id' => rand(3,15),
    ];
});
