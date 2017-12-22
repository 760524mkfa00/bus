<?php

use busRegistration\User;
use Faker\Generator as Faker;

$factory->define(busRegistration\Order::class, function (Faker $faker) {

    $users = User::all()->pluck('id')->toArray();

    return [
        'parent_id' => $faker->randomElement($users),
        'order_number' => $faker->unique()->randomNumber(),
        'school_year' => '2017',
        'paid_amount' => '0'
    ];
});
