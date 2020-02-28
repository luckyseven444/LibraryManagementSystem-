<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fine;
use Faker\Generator as Faker;

$factory->define(Fine::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'amount' => 1
    ];
});
