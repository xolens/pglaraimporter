<?php
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Xolens\PgLaraimporter\App\Model\Record;

$factory->define(Record::class, function (Faker $faker) {
    return [
        'sheet_name' => $faker->name,
        'data' => '{}',
        'import_id' => $faker->randomNumber,
        'import_date' => $faker->date,
        'completed' => $faker->randomElement($array = [true, false]),
    ];
});
