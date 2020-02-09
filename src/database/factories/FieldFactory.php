<?php
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Xolens\PgLaraimporter\App\Model\Field;

$factory->define(Field::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->name,
        'type' => $faker->randomElement($array = ['INTEGER', 'REAL', 'TEXT']),
    ];
});
