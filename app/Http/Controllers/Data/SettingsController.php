<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
