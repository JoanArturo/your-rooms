<?php

namespace App;

use App\Presenters\RoomPresenter;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'description', 'limit', 'active'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function presenter()
    {
        return new RoomPresenter($this);
    }
}
