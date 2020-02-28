<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shelf;
use Faker\Generator as Faker;

$factory->define(Shelf::class, function (Faker $faker) {
    return [
        'row' => 5,
        'pylon' => 5
    ];
});
