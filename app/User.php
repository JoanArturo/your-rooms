<?php

namespace App;

use App\Presenters\UserPresenter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'email', 'password', 'is_admin', 'is_banned', 'gender', 'settings'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings'          => 'array'
    ];

    protected $appends = [
        'messages_reported_against',
        'number_of_reports_against'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class)->withTimestamps();
    }
    
    public function suggestions()
    {
        return $this->hasMany(Suggestion::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function presenter()
    {
        return new UserPresenter($this);
    }

    public function isVerified()
    {
        return ! empty($this->email_verified_at);
    }

    public function getMessagesReportedAgainstAttribute()
    {
        return $this->messages->filter(
            function($message, $key) { 
                return $message->reports->isNotEmpty();
            }
        );
    }

    public function getNumberOfReportsAgainstAttribute()
    {
        return $this->messages_reported_against->count();
    }
}
