<?php
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Xolens\PgLaraimporter\App\Model\ImportField;

$factory->define(ImportField::class, function (Faker $faker) {
    return [
        'import_id' => $faker->randomNumber,
        'field_id' => $faker->randomNumber,
        'position' => $faker->randomNumber,
    ];
});
