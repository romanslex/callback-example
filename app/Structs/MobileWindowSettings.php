<?php

namespace App\Structs;

class MobileWindowSettings
{
    public $currentWindow;

    public $windows;

    public function __toString()
    {
        return json_encode([
            "currentWindow" => $this->currentWindow,
            "windows" => $this->windows
        ]);
    }

    public static function makeFromJson($json)
    {
        $settings = json_decode($json, true);
        $windowSettings = new self;
        $windowSettings->currentWindow = $settings["currentWindow"] ?? null;
        $windowSettings->windows = $settings["windows"] ?? [];
        return $windowSettings;
    }
}