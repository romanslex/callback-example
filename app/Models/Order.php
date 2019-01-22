<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }

    public function scopeReceivedToday($query)
    {
        return $this->scopeReceived($query, Carbon::today()->format("d.m.Y"), Carbon::today()->format("d.m.Y"));
    }

    public function scopeReceived($query, $start, $end)
    {
        return $query
            ->whereDate("orders.created_at", ">=", Carbon::createFromFormat("d.m.Y", $start)->toDateString())
            ->whereDate("orders.created_at", "<=", Carbon::createFromFormat("d.m.Y", $end)->toDateString());
    }
}
