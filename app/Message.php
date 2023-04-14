<?php

namespace App;

use App\Presenters\MessagePresenter;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'body', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function presenter()
    {
        return new MessagePresenter($this);
    }
}
