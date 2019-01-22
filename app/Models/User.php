<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function widgets()
    {
        return $this->hasMany(Widget::class, "owner_id");
    }

    public function blackIps()
    {
        return $this->hasMany(BlackIp::class);
    }

    public function blackPhones()
    {
        return $this->hasMany(BlackPhone::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, Widget::class, "owner_id");
    }
}
