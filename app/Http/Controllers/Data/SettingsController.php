<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            "phone" => "max:255",
            "take_email_notifications" => "required|boolean"
        ]);

        auth()->user()->update(
            collect($validatedData)->only(['name', 'phone', 'take_email_notifications'])
                ->toArray()
        );
        return [];
    }

    public function changePassword(Request $request)
    {
        $validatedData = $request->validate([
            "current_password" => "required|string|min:6",
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($validatedData["current_password"], auth()->user()->getAuthPassword())) {
            return response([
                "errors" => ["current_password" => ["Неверный текущий пароль"]]
            ], 422);
        }

//        auth()->user()->fill([
//            "password" => Hash::make($validatedData["new_password"]),
//        ])->save();
        return [];
    }
}
