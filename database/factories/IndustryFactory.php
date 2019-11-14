<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Industry;
use Faker\Generator as Faker;

$factory->define(Industry::class, function (Faker $faker) {
    return [
        'created_at' =>now(),
        'updated_at'=>now(), 
        'name' => $faker->text(100)
    ];
});
