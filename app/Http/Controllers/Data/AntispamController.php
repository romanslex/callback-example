<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AntispamController extends Controller
{
    public function storeIp(Request $request)
    {
        $validatedData = $request->validate([
            "ip" => [
                "required",
                "ip",
                Rule::unique('black_ips')->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                })
            ],
        ]);

        $ip = auth()->user()->blackIps()->create(["ip" => $validatedData["ip"]]);
        return $ip;
    }
}
