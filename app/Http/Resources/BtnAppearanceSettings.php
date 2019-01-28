<?php

namespace App\Http\Resources;

use App\Models\WidgetDefaultSettings;

class BtnAppearanceSettings
{
    private $widget;

    public function __construct($widget)
    {
        $this->widget = $widget;
    }

    public function toArray()
    {
        $currentBtn = $this->widget->btn_settings->currentBtn
            ?? WidgetDefaultSettings::getCurrentButton();

        $defaultButtons = WidgetDefaultSettings::buttons();

        $buttons = collect($defaultButtons)
            ->mapWithKeys(function($btn, $key){
                if(array_key_exists($key, $this->widget->btn_settings->buttons))
                    return [$key => $this->widget->btn_settings->buttons[$key]];
                return [$key => $btn];
            });

        return [
            "wid" => $this->widget->id,
            "site" => $this->widget->url,
            "currentBtn" => $currentBtn,
            "settings" => $buttons
        ];
    }
}