<?php


use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(busRegistration\User::class, function (Faker $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'primary_phone' => $faker->phoneNumber,
        'secondary_phone' => $faker->phoneNumber,
        'address' => $faker->streetAddress,
        'city' => $faker->randomElement(['Kelowna', 'West Kelowna', 'Lake Country']),
        'province' => 'BC',
        'postal_code' => $faker->postcode,
        'comments' => 'none',
        'accept_rules'  => '1',
        'accept_video'  => '1',
        'accept_email' => '1',
    ];
});
