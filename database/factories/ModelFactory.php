<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->state(\App\Models\User::class,'admin', function (){
    return [
      'role' => \App\Models\User::ROLE_CLIENT
    ];
});

$factory->define(\App\Models\Category::class, function (Faker\Generator $faker){

    return [
      'name' => $faker->name,
      'stream' => $faker->ipv4,
      'card_active' => $faker->imageUrl(),
      'card_inactive' => $faker->imageUrl(),
      'status' => 'active',
      'page' => 'AboutPage',
      'frequency' => 0,
      'icon' => $faker->imageUrl(),
    ];

});

$factory->define(\App\Models\State::class, function (Faker\Generator $faker){

    return [
        'name' => $faker->name,
        'category_id' => rand(1,9),
        'status' => 'active',
    ];

});

$factory->define(\App\Models\Promotion::class, function (Faker\Generator $faker){

    return [
        'name' => $faker->name,
        'card' => $faker->imageUrl(),
        'status' => 'active',
    ];

});
