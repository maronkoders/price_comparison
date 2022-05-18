<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Suburb;
use Faker\Generator as Faker;


$factory->define(Suburb::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'population' => rand(0,999999),
        'city_id' =>rand(1,10),
        'ward_id' =>rand(1,20),
        'constituency_id' => rand(1,50),
        'language_id' => rand(1,20),
    ];
});
