<?php

namespace App\Http\Controllers;

use App\Http\Resources\WindowAppearanceSettings;
use App\Structs\WindowSettings;
use Illuminate\Http\Request;

class WindowAppearanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $widget = auth()->user()->widgets()->findOrFail($id);
        return view(
            'window-appearance',
            (new WindowAppearanceSettings($widget))->toArray()
        );
    }

    public function update(Request $request, $id)
    {
        $widget = auth()->user()->widgets()->findOrFail($id);

        $windowSettings = new WindowSettings();
        $windowSettings->currentWindow = $request->get("currentWindow");
        $windowSettings->windows = $request->get("windows");

        $widget->window_settings = $windowSettings;
        $widget->save();
        return [];
    }
}
