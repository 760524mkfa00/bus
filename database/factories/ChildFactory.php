<?php

use Faker\Generator as Faker;

$factory->define(busRegistration\Child::class, function (Faker $faker) {

    $orders = \busRegistration\Order::all()->pluck('id')->toArray();
    $school = \busRegistration\School::all()->pluck('id')->toArray();
    $grade = \busRegistration\Grade::all()->pluck('id')->toArray();

    return [
        'order_id' => $faker->randomElement($orders),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'address' => $faker->streetAddress,
        'city' => $faker->randomElement(['Kelowna', 'West Kelowna', 'Lake Country']),
        'province' => 'BC',
        'postal_code' => $faker->postcode,
        'current_school_id' => $faker->randomElement($school),
        'next_school_id' => $faker->randomElement($school),
        'grade_id' => $faker->randomElement($grade),
        'medical_information' => $faker->paragraph(1,true),
        'international'  => $faker->randomElement(['yes', 'no']),
        'int_start_date' => $faker->dateTimeThisYear($max = 'now', $timezone = null) ,
        'int_end_date' => $faker->dateTimeThisYear($max = 'now', $timezone = null) ,
        'paid' => $faker->randomElement(['yes', 'no']),
        'seat_assigned' => $faker->randomElement(['yes', 'no']),
        'processed' => $faker->randomElement(['yes', 'no']),
    ];
});