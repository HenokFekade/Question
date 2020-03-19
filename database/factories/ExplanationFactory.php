<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Explanation;
use Faker\Generator as Faker;

$factory->define(Explanation::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence(rand(3,8)),
    ];
});
