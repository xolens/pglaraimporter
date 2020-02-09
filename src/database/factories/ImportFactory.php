<?php
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Xolens\PgLaraimporter\App\Model\Import;

$factory->define(Import::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->name,
        'record_count' => $faker->randomNumber,
        'state' => $faker->randomElement($array = ['UPLOADED', 'RECORDED', 'COMPLETED', 'PARTIAL']),
    ];
});
