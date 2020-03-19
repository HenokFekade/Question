<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,50),
        'grade_id' => rand(6,12),
        'body' => $faker->sentence(rand(2,5)),
    ];
});
