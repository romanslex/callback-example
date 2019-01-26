<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AntispamController extends Controller
{
    public function index()
    {
        return [
            "blackIps" => auth()->user()->blackIps->map(function($ip){
                return ["id" => $ip["id"], "ip" => $ip["ip"]];
            }),
            "blackPhones" => auth()->user()->blackPhones->map(function($phone){
                return ["id" => $phone["id"], "number" => $phone["number"]];
            })
        ];
    }

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

    public function storePhone(Request $request)
    {
        $validatedData = $request->validate([
            "number" => [
                "required",
                Rule::unique('black_phones')->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                })
            ],
        ]);

        $phone = auth()->user()->blackPhones()->create(["number" => $validatedData["number"]]);
        return $phone;
    }
}
