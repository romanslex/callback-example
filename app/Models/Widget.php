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

    /**
     * Вернуть дату конца тестового периода для домена с учетом его
     * истории использования
     * @param $url
     * @return Carbon
     */
    public static function getRateExpiredAt($url)
    {
        $widget = Widget::where("url", $url)->first();
        if (!$widget) {
            return Carbon::today()->addDays(7);
        }
        return $widget->rate_expired_at;
    }

    public function lastOrders()
    {
        $lastOrders = \DB::select("
                select x.date, ifnull(count(o.created_at), 0) amount
                from (
                      select cast(now() as date)  date union all select cast(now() - interval 1 day as date)  date union all
                      select cast(now() - interval 2 day as date)  date union all select cast(now() - interval 3 day as date)  date union all
                      select cast(now() - interval 4 day as date)  date union all select cast(now() - interval 5 day as date)  date union all
                      select cast(now() - interval 6 day as date)  date union all select cast(now() - interval 7 day as date)  date union all
                      select cast(now() - interval 8 day as date)  date union all select cast(now() - interval 9 day as date)  date union all
                      select cast(now() - interval 10 day as date)  date union all select cast(now() - interval 11 day as date)  date union all
                      select cast(now() - interval 12 day as date)  date union all select cast(now() - interval 13 day as date)  date union all
                      select cast(now() - interval 14 day as date)  date union all select cast(now() - interval 15 day as date)  date
                ) x left join orders o on x.date = cast(o.created_at as date) and o.widget_id = ?
                group by x.date
                order by x.date desc", [$this->id]);
        return collect($lastOrders)->pluck("amount")->toArray();
    }

    public static $rates = [
        ["interval" => 1, "price" => "300"],
        ["interval" => 3, "price" => "855"],
        ["interval" => 6, "price" => "1620"],
        ["interval" => 12, "price" => "2400"],
        ["interval" => 24, "price" => "4160"],
    ];

    public function extend($rate)
    {
        if($this->owner->total < self::$rates[$rate]['price'])
            abort(400, "Не хватает денег на балансе");
        $this->owner->total -= self::$rates[$rate]['price'];
        $this->owner->save();
        $this->rate_expired_at = $this->rate_expired_at->addMonths(self::$rates[$rate]['interval']);
        Payment::createExtendPayment($this, self::$rates[$rate]['price']);
        $this->save();
    }
}
