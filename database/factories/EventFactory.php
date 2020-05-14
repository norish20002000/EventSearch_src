<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'introduction'=>$faker->sentence,
        'st_time'=>$faker->time,
        'end_time'=>$faker->time,
        'summary_date'=>$faker->date,
        'web_name'=>$faker->company,
        'web_url'=>"https://www.scrapmagazine.com/event/wasulabonline/",
        'fee_type'=>"料金タイプ",
        'fee'=>$faker->numberBetween(10000, 30000),
        'image_url'=>"https://www.scrapmagazine.com/wp-content/uploads/2020/05/8dc68140a11e3aed4d43cff45abfafab.jpg",
        'reference_name'=>$faker->company,
        'reference_url'=>"https://www.scrapmagazine.com/event/alien_remote/",
        'release_date'=>$faker->date,
        'regi_group_name'=>$faker->domainWord,
        'regi_name'=>$faker->name,
        'regi_tel'=>$faker->phoneNumber,
        'regi_mail'=>$faker->safeEmail,
        'status'=>0,
    ];
});
