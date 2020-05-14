<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\GenreMap;
use Faker\Generator as Faker;

$factory->define(GenreMap::class, function (Faker $faker) {
    return [
        'genre_id' => $faker->numberBetween(1, 5),
        'event_id' => $faker->numberBetween(1, 10),
    ];
});
