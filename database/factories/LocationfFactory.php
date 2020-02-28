<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'stock_id' => 1,
        'shelf_id' => 1,
        'row' => 1,
        'pylon' => 1
    ];
});
