<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\VisitIn;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Patient;
use App\User;
use App\Hospital;

$factory->define(VisitIn::class, function (Faker $faker) {
    
    $date=new Carbon();
    $randomDays = mt_rand(1,31);
    
    return [
        'myCash'=>rand(200,2000),
        'date'=>$date->addDays($randomDays),
        'patient_ID'=>Patient::all()->random(),
        'user_ID'=>User::all()->random(),
        'notes'=>null,
        'hospital_ID'=>Hospital::all()->random(),
        'isExist'=>true,
        'Finished'=>false,
        'datefinish'=>null
    ];
});
