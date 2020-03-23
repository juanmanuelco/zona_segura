<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;



$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'longitud' => $faker->latitude($min = -90, $max = 90)  ,  
        'latitud' => $faker->longitude($min = -180, $max = 180) ,
        'estado' => $faker->randomElement($array = array ('0','1','2','3', '4')) 
    ];
});
