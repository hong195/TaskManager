<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Step::class, function (Faker $faker) {
    return [
        'cell_id' => function () { factory(\App\Cell::class)->create()->id;},
        'name' => 'Complete ' . $faker->word(),
        'status' => 'incomplete',
        'deadline'=> $faker->dateTimeBetween('now', '+30 days'),
    ];
});
