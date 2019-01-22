<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResponseModel;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function getOrders(Request $request)
    {
        $validatedData = $request->validate([
            "s" => "required|date_format:d.m.Y",
            "e" => "required|date_format:d.m.Y",
        ]);

        $start = $validatedData["s"];
        $end = $validatedData["e"];

        return new OrdersResponseModel(
            auth()
                ->user()
                ->orders()
                ->received($start, $end)
                ->orderBy("created_at", "desc")
                ->paginate(20)
        );
    }
}
