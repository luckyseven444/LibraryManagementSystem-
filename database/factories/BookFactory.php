<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->text($maxNbChars = 20),
        'author_id' => $faker->randomDigitNotNull,
        'price' => $faker->numberBetween($min = 500, $max = 900),
        'genre_id' => 1,
        'date_of_publication' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null),
        'ISBN' => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
        'created_at' => $faker->dateTime($max = 'now', $timezone = null)
    ];
});
