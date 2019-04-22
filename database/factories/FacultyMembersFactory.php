<?php

use Faker\Generator as Faker;
use App\facultyMembers;

$factory->define(App\facultyMembers::class, function (Faker $faker) {
    $path = storage_path() . "/json/job.json";

    $json = json_decode(file_get_contents($path), true);
    $random = Arr::random($json, 1);

    return [
        'name' => $faker->name,
        'job' => $random[0]['name']
    ];
});
