<?php

namespace App\Http\Resources;

use App\Models\WidgetDefaultSettings;

class MobileAppearanceSettings
{
    private $widget;

    public function __construct($widget)
    {
        $this->widget = $widget;
    }

    public function toArray()
    {
        $settings = [
            "wid" => $this->widget->id,
        ];
        $btnSettings = $this->getBtnSettings();
        $windowSettings = $this->getWindowSettings();

        return array_merge($settings, $btnSettings, $windowSettings);
    }

    private function getBtnSettings()
    {
        $currentBtn = $this->widget->mobile_btn_settings->currentBtn
            ?? WidgetDefaultSettings::getCurrentMobileButton();

        $defaultButtons = WidgetDefaultSettings::mobileButtons();

        $buttons = collect($defaultButtons)
            ->mapWithKeys(function($btn, $key){
                if(array_key_exists($key, $this->widget->mobile_btn_settings->buttons))
                    return [$key => $this->widget->mobile_btn_settings->buttons[$key]];
                return [$key => $btn];
            });

        return [
            "currentBtn" => $currentBtn,
            "btnSettings" => $buttons
        ];
    }

    private function getWindowSettings()
    {
        $currentWindow = $this->widget->mobile_window_settings->currentWindow
            ?? WidgetDefaultSettings::getCurrentMobileWindow();

        $defaultWindows = WidgetDefaultSettings::mobileWindows();

        $windows = collect($defaultWindows)->mapWithKeys(function($window, $key){
            if(array_key_exists($key, $this->widget->mobile_window_settings->windows))
                return [$key => $this->widget->mobile_window_settings->windows[$key]];
            return [$key => $window];
        });

        return [
            "currentWindow" => $currentWindow,
            "windowSettings" => $windows
        ];
    }
}