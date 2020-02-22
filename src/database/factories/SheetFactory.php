<?php
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Xolens\PgLaraimporter\App\Model\Sheet;

$factory->define(Sheet::class, function (Faker $faker) {
    return [
        'import_id' => $faker->randomNumber,
        'name' => $faker->name,
        'record_count' => $faker->randomNumber,
    ];
});
