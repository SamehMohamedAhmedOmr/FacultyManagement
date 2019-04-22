<?php

use Faker\Generator as Faker;
use App\research;

$factory->define(App\research::class, function (Faker $faker) {

    return [
        'researchName' => $faker->paragraph,
        'magazine' => $faker->sentence,
        'publishDate' => $faker->date,
        'participantsBonusValue' => $faker->randomNumber(4),
        'publishPlace' => $faker->city,
        'effectCoefficient' => $faker->randomFloat(2 , 0, 3) ,
        'bonusValue' => $faker->randomFloat(4 , 0, 2) ,
        'facultymemberId' => function () {
            return factory(App\facultyMembers::class)->create()->id;
        }
    ];
});
