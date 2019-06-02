<?php
use Illuminate\Hashing\BcryptHasher;

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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'role_id' => $faker->randomElement([1, 2, 3, 4, 5]),
        'username' => $faker->userName,
        'email' => $faker->email,
        'password' => (new BcryptHasher)->make('secret'),
    ];
});
