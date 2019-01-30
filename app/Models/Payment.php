<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'performed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePerformedToday($query)
    {
        return $this->scopePerformed($query, Carbon::today()->format("d.m.Y"), Carbon::today()->format("d.m.Y"));
    }

    public function scopePerformed($query, $start, $end)
    {
        return $query
            ->whereDate("performed_at", ">=", Carbon::createFromFormat("d.m.Y", $start)->toDateString())
            ->whereDate("performed_at", "<=", Carbon::createFromFormat("d.m.Y", $end)->toDateString());
    }

    public static function createExtendPayment(Widget $widget, $sum)
    {
        return self::create([
            "user_id" => $widget->owner->id,
            "info" => "Продление тарифа",
            "site" => $widget->url,
            "sum" => $sum,
            "is_replenishment" => false,
            "performed_at" => now()
        ]);
    }
}
