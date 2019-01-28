<?php

namespace App\Http\Controllers;

use App\Http\Resources\MobileAppearanceSettings;
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
}
