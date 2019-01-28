<?php

namespace App\Http\Controllers;

use App\Http\Resources\MobileAppearanceSettings;
use App\Structs\MobileBtnSettings;
use App\Structs\MobileWindowSettings;
use Illuminate\Http\Request;

class MobileAppearanceController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index($id)
    {
        $widget = auth()->user()->widgets()->findOrFail($id);
        return view(
            "mobile-appearance",
            (new MobileAppearanceSettings($widget))->toArray()
        );
    }

    public function updateBtn(Request $request, $id)
    {
        $widget = auth()->user()->widgets()->findOrFail($id);

        $mobileBtnSettings = new MobileBtnSettings();
        $mobileBtnSettings->currentBtn = $request->get("currentBtn");
        $mobileBtnSettings->buttons = $request->get("buttons");

        $widget->mobile_btn_settings = $mobileBtnSettings;
        $widget->save();
        return [];
    }

    public function updateWindow(Request $request, $id)
    {
        $widget = auth()->user()->widgets()->findOrFail($id);

        $mobileWindowSettings = new MobileWindowSettings();
        $mobileWindowSettings->currentWindow = $request->get("currentWindow");
        $mobileWindowSettings->windows = $request->get("windows");

        $widget->mobile_window_settings = $mobileWindowSettings;
        $widget->save();
        return [];
    }
}
