<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $validatedData = $request->validate([
            "s" => "required|date_format:d.m.Y",
            "e" => "required|date_format:d.m.Y",
        ]);

        $start = $validatedData["s"];
        $end = $validatedData["e"];

        return auth()
            ->user()
            ->payments()
            ->performed($start, $end)
            ->orderBy("performed_at", "desc")
            ->get()
            ->map(function($payment){
                return [
                    "performed_at" => $payment->performed_at->format("d.m.Y в H:i"),
                    "info" => $payment->info,
                    "sum" => $payment->sum,
                    "site" => $payment->site,
                    "is_replenishment" => $payment->is_replenishment
                ];
            });
    }
}
