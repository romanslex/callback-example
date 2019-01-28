<?php

namespace App\Http\Resources;

use App\Models\WidgetDefaultSettings;

class WindowAppearanceSettings
{
    private $widget;

    public function __construct($widget)
    {
        $this->widget = $widget;
    }

    public function toArray()
    {
        $currentWindow = $this->widget->window_settings->currentWindow
            ?? WidgetDefaultSettings::getCurrentWindow();

        $defaultWindows = WidgetDefaultSettings::windows();

        $windows = collect($defaultWindows)->mapWithKeys(function($window, $key){
            if(array_key_exists($key, $this->widget->window_settings->windows))
                return [$key => $this->widget->window_settings->windows[$key]];
            return [$key => $window];
        });

        return [
            "wid" => $this->widget->id,
            "site" => $this->widget->url,
            "currentWindow" => $currentWindow,
            "settings" => $windows
        ];
    }
}