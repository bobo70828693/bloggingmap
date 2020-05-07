<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Users;
use Faker\Generator as Faker;

$factory->define(Users::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'token' => Hash::make('token'),
        'email' => Str::random(10) . '@gmail.com',
        'password' => Hash::make('secret'),
    ];
});
