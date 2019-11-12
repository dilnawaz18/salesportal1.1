<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker) {
    return [
        'created_at' =>now(),
        'updated_at'=>now(), 
        'name' => $faker->address(100)
        
    ];
});
