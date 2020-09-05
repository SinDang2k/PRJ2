<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Teacher;

$factory->define(Teacher::class, function () {
	$faker = Faker\Factory::create('vi_VN');

    return [
        'images'         => $faker->image('public/upload/',400,300),
        'teacher_name'   => $faker->name(),
        'birthday'       => $faker->date($fomat = 'Y-m-d'),
        'phone'          => $faker->e164PhoneNumber,
        'address'        => $faker->streetAddress,
        'gender'         => $faker->boolean,
        'email'          => $faker->unique()->freeEmail,
        'status'         => 0,
        'password'       => bcrypt('secret123')
    ];
});
