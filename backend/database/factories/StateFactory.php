<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\State;
use Faker\Generator as Faker;

$factory->define(State::class, function (Faker $faker) {
    return [
        'name' => $faker->state
    ];
});
