<?php

namespace App\Http\Controllers;

use App\Http\Resources\BtnAppearanceSettings;
use App\Structs\BtnSettings;
use Illuminate\Http\Request;

class BtnAppearanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $widget = auth()->user()->widgets()->findOrFail($id);
        return view(
            'btn-appearance',
            (new BtnAppearanceSettings($widget))->toArray()
        );
    }

    public function update(Request $request, $id)
    {
        $widget = auth()->user()->widgets()->findOrFail($id);

        $btnSettings = new BtnSettings();
        $btnSettings->currentBtn = $request->get("currentBtn");
        $btnSettings->buttons = $request->get("buttons");

        $widget->btn_settings = $btnSettings;
        $widget->save();
        return [];
    }
}
