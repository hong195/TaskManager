<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Term::class, function (Faker $faker) {
    return [
        'text' =>
            $faker->word()
        ,
        'type' => function ($word) {
            $word ? $word : 'миссия';
        },
        'bu_id' => function ($unit) {
            $unit->factory(\App\Unit::class)->create()->id;
        },
    ];
});
