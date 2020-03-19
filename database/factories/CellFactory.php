<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cell;
use Faker\Generator as Faker;

$factory->define(Cell::class, function (Faker $faker) {
    return [
        'block_id' => function () { factory(\App\Block::class)->create()->id;},
        'name' => 'Create ' . $faker->word(),
    ];
});
