<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CheckOut;
use Faker\Generator as Faker;

$factory->define(CheckOut::class, function (Faker $faker) {
    return [
         'user_id' => 1,
         'stock_id' => 1
    ];
});
