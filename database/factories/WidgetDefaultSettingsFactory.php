<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\WidgetDefaultSettings::class, function (Faker $faker) {
    return [
        "type" => "window",
        "name" => "w1",
        "settings" => []
    ];
});
