<?php

namespace App\Models;

use App\Structs\BtnSettings;
use App\Structs\MobileBtnSettings;
use App\Structs\MobileWindowSettings;
use App\Structs\WindowSettings;
use App\Traits\PhoneNumberFormatter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Widget extends Model
{
    use PhoneNumberFormatter;

    public $incrementing = false;

    protected $guarded = ["id", "owner_id"];

    protected $dates = [
        'created_at',
        'updated_at',
        'rate_expired_at'
    ];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string)Uuid::generate(4);
        });
    }

    public function isExpired()
    {
        return Carbon::now()->gte($this->rate_expired_at);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, "owner_id");
    }

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getEmailsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setEmailsAttribute($value)
    {
        $this->attributes["emails"] = json_encode($value);
    }

    public function getPhonesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setPhonesAttribute($value)
    {
        if (empty($value)) {
            $this->attributes["phones"] = json_encode($value);
            return;
        }
        $value = collect($value)->map(function ($phone) {
            $string = $this->formatNumber($phone["value"]);
            return ["value" => $string];
        });
        $this->attributes["phones"] = json_encode($value);
    }

    public function getScheduleAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setScheduleAttribute($value)
    {
        $this->attributes["schedule"] = json_encode($value);
    }

    /**
     * window_settings attribute
     * @param $value
     * @return WindowSettings
     */
    public function getWindowSettingsAttribute($value): WindowSettings
    {
        return WindowSettings::makeFromJson($value);
    }

    public function setWindowSettingsAttribute(?WindowSettings $value)
    {
        $this->attributes["window_settings"] = (string)$value;
    }

    /**
     * btn_settings attribute
     * @param $value
     * @return BtnSettings
     */
    public function getBtnSettingsAttribute($value): BtnSettings
    {
        return BtnSettings::makeFromJson($value);
    }

    public function setBtnSettingsAttribute(?BtnSettings $value)
    {
        $this->attributes["btn_settings"] = (string)$value;
    }

    /**
     * mobile_window_settings attribute
     * @param $value
     * @return MobileWindowSettings
     */
    public function getMobileWindowSettingsAttribute($value): MobileWindowSettings
    {
        return MobileWindowSettings::makeFromJson($value);
    }

    public function setMobileWindowSettingsAttribute(?MobileWindowSettings $value)
    {
        $this->attributes["mobile_window_settings"] = (string)$value;
    }

    /**
     * mobile_btn_settings attribute
     * @param $value
     * @return MobileBtnSettings
     */
    public function getMobileBtnSettingsAttribute($value): MobileBtnSettings
    {
        return MobileBtnSettings::makeFromJson($value);
    }

    public function setMobileBtnSettingsAttribute(?MobileBtnSettings $value)
    {
        $this->attributes["mobile_btn_settings"] = (string)$value;
    }

    public static $defaultSchedule = [
        "is_weekdays_same_schedule" => true,
        "time_start" => ["08:00", "08:00", "08:00", "08:00", "08:00", "10:00", "10:00"],
        "time_end" => ["17:00", "17:00", "17:00", "17:00", "17:00", "16:00", "16:00"],
        "workdays" => [true, true, true, true, true, false, false],

        "weekdays_start" => "08:00",
        "weekdays_end" => "17:00",
        "weekdays_workdays" => true
    ];


    public function lastOrders()
    {
        $lastOrders = \DB::select("
            with recursive x as (
                select cast(now() as date) as date
                union all
                select cast(x.date - interval '1 day' as date) from x
                where cast(x.date - interval '1 day' as date) >= cast(now() - interval '15 day' as date)
            )
            select x.date, coalesce(count(o.*), 0) as amount
            from x left join orders o on cast(o.created_at as date) = x.date
            where widget_id = ? or widget_id is null
            group by x.date
            order by x.date desc", [$this->id]);
        return collect($lastOrders)->pluck("amount")->toArray();
    }
}
