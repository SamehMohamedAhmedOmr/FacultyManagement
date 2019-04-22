<?php

use Faker\Generator as Faker;
use App\facultyMembers;
use App\vacation;

$factory->define(App\vacation::class, function (Faker $faker) {

    $path1 = storage_path() . "/json/vacationType.json";

    $json1 = json_decode(file_get_contents($path1), true);
    $randomType = Arr::random($json1, 1);


    $path2 = storage_path() . "/json/countries.json";

    $json2 = json_decode(file_get_contents($path2), true);
    $randomCountries = Arr::random($json2, 1);

    return [
        'description' => $faker->text,
        'startDate' => $faker->date,
        'endDate' => $faker->date,
        'decisionNumber' => $faker->randomDigit,
        'decisionDate' => $faker->date,
        'VacationType' => $randomType[0]['name'],
        'countryName' => $randomCountries[0]['name'],
        'yearNumber' => $faker->randomDigit,
        'facultymemberId' => function () {
            return factory(App\facultyMembers::class)->create()->id;
        }
    ];
});
