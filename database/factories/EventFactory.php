<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'description' => $faker->sentence,
        'creator_id' => factory(User::class)->create()->id
    ];
});
