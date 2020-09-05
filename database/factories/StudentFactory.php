<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;


$factory->define(Student::class, function () {
    $faker = Faker\Factory::create('vi_VN');

    return [
        'student_name' => $faker->name,
        'email'        => $faker->unique()->freeEmail,
        'password'     => bcrypt('123456'),
        'birthday'     => $faker->date($fomat = 'Y-m-d'),
        'phone'        => $faker->e164PhoneNumber,
        'address'      => $faker->streetAddress,
        'gender'       => $faker->boolean,
        'classes_id'   => App\Models\Classes::inRandomOrder()->value('id')
    ];
});
