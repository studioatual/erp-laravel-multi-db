<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Plan;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker) {
    return [
        'name' => $faker->state,
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 100, $max = 300),
        'description' => $faker->sentence($nbWords = 5, $variableNbWords = true),
    ];
});
