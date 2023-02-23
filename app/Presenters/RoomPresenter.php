<?php namespace App\Presenters;

use Illuminate\Support\HtmlString;

class RoomPresenter extends Presenter
{
    public function name()
    {
        return new HtmlString("<a href='#'>{$this->entity->name}</a>");
    }

    public function usersOnlineNumber()
    {
        $userOnline = $this->entity->users->count();
        $html = "<span>{$userOnline}</span>";

        if ($userOnline == $this->entity->limit)
            $html .= "<span class='badge badge-danger ml-1'>". __('Full') ."</span>";
        else if ($userOnline >= $this->entity->limit - ($this->entity->limit / 5))
            $html .= "<span class='badge badge-warning ml-1'>". __('Almost full') ."</span>";
        
        return new HtmlString($html);
    }

    public function createdAt()
    {
        return $this->entity->created_at->diffForHumans();
    }
}