<?php namespace App\Presenters;

use Illuminate\Support\HtmlString;

class RoomPresenter extends Presenter
{
    public function name()
    {
        return new HtmlString("<a href='". route('admin.room.show', $this->entity) ."'>{$this->entity->name}</a>");
    }

    public function usersOnlineNumber()
    {
        return $this->entity->users->count();
    }

    public function usersOnlineNumberWithIndicator()
    {
        $userOnline = $this->usersOnlineNumber();
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

    public function status()
    {
        $status = $this->entity->active ? __('Active') : __('Inactive');
        $badgeColor = $this->entity->active ? 'success' : 'warning';

        return new HtmlString("<span class='badge badge-{$badgeColor}'>{$status}</span>");
    }
}