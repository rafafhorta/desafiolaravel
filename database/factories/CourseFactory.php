<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'text' => $faker->text($maxNbChars = 300),
        'imglink' => $faker-> imageUrl($width = 640, $height = 480),
        'slug' => 'name',
        'videolink' => 'https://www.youtube.com/embed/fM9wiB7DR_k',
        'category_id' => '1',
    ];
});
