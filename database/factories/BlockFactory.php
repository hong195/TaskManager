<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Block;
use Faker\Generator as Faker;

$factory->define(Block::class, function (Faker $faker) {
    return [
        'section_id' => function () { factory(\App\Section::class)->create()->id;},
        'name' => $faker->word(),
    ];
});
