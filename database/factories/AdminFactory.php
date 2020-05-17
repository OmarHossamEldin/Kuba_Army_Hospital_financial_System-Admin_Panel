<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    
    return [
        'name'=>"admin",
        'username'=>"admin",
        'password'=>bcrypt(123456789),
        'permission'=>1
    ];
});
