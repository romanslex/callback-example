<?php

namespace App\Structs;

class BtnSettings
{
    public $currentBtn;

    public $buttons;

    public function __toString()
    {
        return json_encode([
            "currentBtn" => $this->currentBtn,
            "buttons" => $this->buttons
        ]);
    }

    public static function makeFromJson($json)
    {
        $settings = json_decode($json, true);
        $btnSettings = new self;
        $btnSettings->currentBtn = $settings["currentBtn"] ?? null;
        $btnSettings->buttons = $settings["buttons"] ?? [];
        return $btnSettings;
    }
}