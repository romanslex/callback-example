<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Payment::class, function (Faker $faker) {
    return [
        "info" => $faker->sentence(3),
        "site" => $faker->domainName,
        "sum" => $faker->numberBetween(0, 30000),
        "is_replenishment" => $faker->boolean,
        "performed_at" => $faker->dateTimeBetween("-4 month", "now")
    ];
});
