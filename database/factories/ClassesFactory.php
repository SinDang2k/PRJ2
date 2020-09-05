<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Classes;
use Faker\Generator as Faker;

$factory->define(Classes::class, function (Faker $faker) {
    return [
        'classes_name'   => $faker->randomDigit,
        'department_id'  => App\Models\Department::inRandomOrder()->value('id'),
        'course_id'      => App\Models\Course::inRandomOrder()->value('id')
    ];
});
