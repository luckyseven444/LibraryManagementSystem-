<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Stock;
use Faker\Generator as Faker;

$factory->define(Stock::class, function (Faker $faker) {

    return [
        'book_id' => 1,
        'stock' => 1,
        'status' => 1
    ];
});
