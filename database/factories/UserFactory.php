<?php

$factory->define(App\UserRole::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        //'remember_token' => str_random(10),
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(str_random(10)),
        'role_id' => $faker->unique()->numberBetween($min = 1, $max = 3),
        //'remember_token' => str_random(10),
    ];
});

// TO DO
$factory->define(App\Visitor::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->unique()->numberBetween($min = 1, $max = 10),
        'password' => bcrypt(str_random(10)),
    ];
});

$factory->define(App\Organiser::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
    ];
});

$factory->define(App\Admin::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
    ];
});
