<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WidgetDefaultSettings extends Model
{
    protected $guarded = [];

    public function getSettingsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setSettingsAttribute($value)
    {
        $this->attributes["settings"] = json_encode($value);
    }

    public function scopeWindows($query)
    {
        return $query
            ->where("type", "window")
            ->get()
            ->mapWithKeys(function($window){
                return [$window->name => $window->settings];
            });
    }

    public static function getCurrentWindow()
    {
        return self::where("type", "currentWindow")->firstOrFail()->name;
    }

    public function scopeButtons($query)
    {
        return $query
            ->where("type", "btn")
            ->get()
            ->mapWithKeys(function($btn){
                return [$btn->name => $btn->settings];
            });
    }

    public static function getCurrentButton()
    {
        return self::where("type", "currentBtn")->firstOrFail()->name;
    }

    public function scopeMobileButtons($query)
    {
        return $query
            ->where("type", "mobileBtn")
            ->get()
            ->mapWithKeys(function($mobileBtn){
                return [$mobileBtn->name => $mobileBtn->settings];
            });
    }

    public static function getCurrentMobileButton()
    {
        return self::where("type", "currentMobileBtn")->firstOrFail()->name;
    }

    public function scopeMobileWindows($query)
    {
        return $query
            ->where("type", "mobileWindow")
            ->get()
            ->mapWithKeys(function($mobileWindow){
                return [$mobileWindow->name => $mobileWindow->settings];
            });
    }

    public static function getCurrentMobileWindow()
    {
        return self::where("type", "currentMobileWindow")->firstOrFail()->name;
    }
}
