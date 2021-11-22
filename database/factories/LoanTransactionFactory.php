<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Domains\Auth\Models\LoanTransactions;
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

$factory->define(LoanTransactions::class, function (Faker $faker) {
    return [
        'loan_id' => $faker->randomNumber(),
        'amount' => $faker->randomNumber(),
        'remain' => 0,
        'status' => 1,
        'due_date' => $faker->date($format = 'Y-m-d', $max = '+30 days'),
    ];
});
