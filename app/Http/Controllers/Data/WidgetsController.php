<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WidgetsController extends Controller
{
    public function getWidgets()
    {
        return auth()->user()->widgets->map(function($widget){
            return [
                "id" => $widget->id,
                "url" => $widget->url,
                "orders" => $widget->lastOrders(),
                "rateExpiredAt" => $widget->rate_expired_at->format("d.m.Y"),
                "isExpired" => $widget->isExpired(),
            ];
        });
    }
}
