<?php namespace App\Presenters;

use Illuminate\Support\HtmlString;

class UserPresenter extends Presenter
{
    public function name()
    {
        return new HtmlString("<a href='#'>{$this->entity->name}</a>");
    }

    public function role()
    {
        return $this->entity->is_admin ? __('Administrator') : __('User');
    }

    public function status()
    {
        $status = $this->entity->is_banned ? __('Banned') : __('Active');
        $badgeColor = $this->entity->is_banned ? 'danger' : 'success';

        return new HtmlString("<span class='badge badge-{$badgeColor}'>{$status}</span>");
    }

    public function createdAt()
    {
        return $this->entity->created_at->diffForHumans();
    }
}