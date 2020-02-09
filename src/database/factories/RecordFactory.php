<?php
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Xolens\PgLaraimporter\App\Model\Record;

$factory->define(Record::class, function (Faker $faker) {
    return [
        'data' => $faker->name,
        'import_id' => $faker->randomNumber,
        'import_date' => $faker->date,
        'validation_date' => $faker->date,
        'raw_data' => $faker->name,
    ];
});
