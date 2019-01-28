<?php

namespace App\Http\Controllers;

use App\Http\Resources\BtnAppearanceSettings;
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
}
