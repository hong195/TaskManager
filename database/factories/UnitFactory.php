<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Unit;
use Faker\Generator as Faker;

$factory->define(Unit::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'address' => $faker->address(),
        'itc' => $faker->numberBetween(111111111, 999999999),
        'website' => $faker->word(). '.org',
        'director' => $faker->name . ' ' . $faker->lastName,
        'phone' => '+' . $faker->numberBetween(111111111, 999999999)
    ];
});
