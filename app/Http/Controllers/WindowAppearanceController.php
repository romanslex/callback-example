<?php

namespace App\Http\Controllers;

use App\Http\Resources\WindowAppearanceSettings;
use Illuminate\Http\Request;

class WindowAppearanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
        $widget = auth()->user()->widgets()->findOrFail($id);
        return view(
            'window-appearance',
            (new WindowAppearanceSettings($widget))->toArray()
        );
    }
}
