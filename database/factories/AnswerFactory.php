<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    $incorrect = array();
    for ($i=0; $i < 3; $i++) {
        $incorrect[$i] = $faker->sentence(1);
    }
    return [
        'question_id' => 1,
        'correct' => $faker->sentence(),
        'incorrect' => json_encode($incorrect),
    ];
});
