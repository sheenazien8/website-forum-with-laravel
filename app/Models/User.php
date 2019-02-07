<?php

namespace App\Models;
use App\Models\Quote;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function comments()
    {
        return $this->hasMany(QuoteComment::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
