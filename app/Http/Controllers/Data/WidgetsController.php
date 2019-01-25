<?php

namespace App\Http\Controllers\Data;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WidgetsController extends Controller
{
    public function getWidgets()
    {
        return auth()->user()->widgets->map(function ($widget) {
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
            if (array_key_exists("id", $region)){
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
}
