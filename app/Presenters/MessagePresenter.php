<?php namespace App\Presenters;

use Illuminate\Support\Facades\Auth;

class MessagePresenter extends Presenter
{
    public function body()
    {
        $reports = $this->entity->reports;

        if (! $reports)
            return $this->entity->body;
        
        $user = Auth::user();
        $showBlockedMessage = $reports->where('user_id', $user->id)->count();
       
        return $showBlockedMessage ? __('- MESSAGE BLOCKED -') : $this->entity->body;
    }
}