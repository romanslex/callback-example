<?php

namespace App\Http\Controllers\Data;

use App\Models\Region;
use App\Models\Widget;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class WidgetsController extends Controller
{
    public function getWidgets()
    {
        return auth()
            ->user()
            ->widgets()
            ->orderBy("created_at")
            ->get()
            ->map(function ($widget) {
                return [
                    "id" => $widget->id,
                    "url" => $widget->url,
                    "orders" => $widget->lastOrders(),
                    "rateExpiredAt" => $widget->rate_expired_at->format("d.m.Y"),
                    "isExpired" => $widget->isExpired(),
                ];
            });
    }

    public function getWidgetById($id)
    {
        return auth()
            ->user()
            ->widgets()
            ->with("regions")
            ->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "autodisplay_delay" => [
                "numeric",
                function ($attribute, $value, $fail) {
                    if ($value < 5 || $value > 60) {
                        return $fail('Поле "Автоматически показывать окно" должно содержать значение в диапазоне от 5 до 60');
                    }
                },
            ],
            "emails.*.value" => "email"
        ]);

        $widget = auth()->user()->widgets()->findOrFail($id);

        $widget->update($request->except([
            "regions",
            "window_settings",
            "btn_settings",
            "mobile_btn_settings",
            "mobile_window_settings",
        ]));
        $widget->regions()->delete();
        $regions = collect($request->get("regions"))->map(function ($region) {
            if (array_key_exists("id", $region)) {
                return Region::make([
                    "id" => $region["id"],
                    "name" => $region['name'],
                    "code" => $region["code"],
                    "uid" => $region["uid"]
                ]);
            }
            return Region::make([
                "name" => $region['name'],
                "code" => $region["code"],
                "uid" => $region["uid"]
            ]);
        });
        $widget->regions()->saveMany($regions);

        return [];
    }

    public function store(Request $request)
    {
        $request->validate([
            "url" => [
                "required",
                "max:255",
                Rule::unique("widgets")->where(function ($query) {
                    return $query->where("owner_id", auth()->user()->id);
                })
            ]
        ]);

        $widget = auth()->user()->widgets()->create([
            "url" => $request->get("url"),
            "emails" => [["value" => auth()->user()->email]],
            "phones" => [],
            "schedule" => Widget::$defaultSchedule,
            "window_settings" => null,
            "btn_settings" => null,
            "mobile_btn_settings" => null,
            "mobile_window_settings" => null,
            "rate_expired_at" => Widget::getRateExpiredAt($request->get('url')),
            "timezone" => "Europe/Moscow",
        ]);

        return [
            "id" => $widget->id,
            "url" => $widget->url,
            "orders" => $widget->lastOrders(),
            "rateExpiredAt" => $widget->rate_expired_at->format("d.m.Y"),
            "isExpired" => $widget->isExpired(),
        ];
    }
}
