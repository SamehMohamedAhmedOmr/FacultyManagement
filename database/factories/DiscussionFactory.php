<?php

use Faker\Generator as Faker;

use App\discussion;

$factory->define(App\discussion::class, function (Faker $faker) {
    $path1 = storage_path() . "/json/Department.json";

    $json1 = json_decode(file_get_contents($path1), true);
    $randomDepartment = Arr::random($json1, 1);

    return [
        'discussionName' => $faker->text,
        'discussionDate' => $faker->date,
        'department' => $randomDepartment[0]['name'],
        'facultymemberId' => function () {
            return factory(App\facultyMembers::class)->create()->id;
        }
    ];

});
