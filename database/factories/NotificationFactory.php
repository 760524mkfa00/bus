<?php

use Faker\Generator as Faker;

$factory->define(busRegistration\Notification::class, function (Faker $faker) {

    $users = \busRegistration\User::all()->pluck('id')->toArray();

    return [
        'parent_id' => $faker->randomElement($users),
        'notification' => $faker->paragraph(1, true)
    ];
});
