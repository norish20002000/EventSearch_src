<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'title'=>$faker->title,
        'detail'=>$faker->sentence,
        'thumb_url'=>"https://www.scrapmagazine.com/wp-content/uploads/2020/05/549a88f1fada4ac9a6f94a4199fe0f99-208x208.jpg",
        'image_url'=>"https://www.scrapmagazine.com/wp-content/uploads/2020/05/8dc68140a11e3aed4d43cff45abfafab.jpg",
        'summary'=>$faker->word,
        'st_date'=>$faker->date,
        'end_date'=>$faker->date,
        'st_time'=>$faker->time,
        'end_time'=>$faker->time,
        'fee'=>$faker->numberBetween(10000, 30000),
        'deli_format'=>$faker->word,
        'status'=>0,
    ];
});
