<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\File;
use App\Model;
use Faker\Generator as Faker;

$factory->define(File::class, function (Faker $faker) {
    $word = $faker->word();
    return [
        'name' => function($word){$word;},
        'source' => function($word){$word;},
        'extension' => 'png',
        'size' => function($faker){$faker->randomDigitNotNull;},
        'bu_id' => function () { factory(\App\Unit::class)->create()->id; },
    ];
});
