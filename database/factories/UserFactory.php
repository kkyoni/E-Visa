<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
	return [
	'name' => 'Khalid',
	'email' => 'khalid@aistechnolabs.xyz',
	'email_verified_at' => now(),
	'role_id' => '1',
	'user_type' => 'superadmin',
        'password' => '$2y$10$2m5Vmj.Mxi7Pg5or9BT4f.VbAY3wgF1sSEkdkCFxdnvXfCpJ7f33y', // 123456
        'remember_token' => Str::random(10),
        ];
    });
