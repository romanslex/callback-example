<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Order::class, function (Faker $faker) {
    return [
        "widget_id" => 1,
        "phone" => $faker->phoneNumber,
        "created_at" => $faker->dateTimeBetween("-4 month", "now")
    ];
});
