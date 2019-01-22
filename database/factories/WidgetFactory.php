<?php

use App\Models\Widget;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Webpatser\Uuid\Uuid;

$factory->define(Widget::class, function (Faker $faker) {
    return [
        "id" =>  Uuid::generate(4),
        "url" => $faker->domainName,
        "window_settings" => null,
        "btn_settings" => null,
        "mobile_btn_settings" => null,
        "mobile_window_settings" => null,
        "rate_expired_at" => Carbon::today()->addDays(7),
        "emails" => [["value" => $faker->email]],
        "phones" => [],
        "timezone" => "Europe/Moscow",
        "schedule" => Widget::$defaultSchedule,
    ];
});
