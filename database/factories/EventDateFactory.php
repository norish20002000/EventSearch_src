<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EventDate;
use Faker\Generator as Faker;

$factory->define(EventDate::class, function (Faker $faker) {
    return [
        'event_id'=>$faker->numberBetween(1, 10),
        'event_date'=>$faker->dateTimeBetween('-5 days', '+5 days')
    ];
});
