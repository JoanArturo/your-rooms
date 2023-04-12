<?php namespace App\Presenters;

use Illuminate\Support\HtmlString;

class UserPresenter extends Presenter
{
    public function name()
    {
        return new HtmlString("<a href='". route('admin.user.show', $this->entity) ."'>{$this->entity->name}</a>");
    }

    public function profilePicture()
    {
        $profilePicture = $this->entity->profile_picture ? asset('storage/' . $this->entity->profile_picture) : asset('icons/camera.svg');
        $styleClass = $this->entity->profile_picture ? 'has-profile-image' : '';

        return new HtmlString("<img src='{$profilePicture}' alt='Profile image' class='{$styleClass}'>");
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

    public function messageColor()
    {
        if (empty($this->entity->settings))
            return;

        $settings = $this->entity->settings;

        return $settings['message_color'];
    }

    public function activeColor()
    {
        return $this->entity->is_active ? 'success' : 'gray';
    }

    public function activeText()
    {
        return $this->entity->is_active ? __('Online') : __('Offline');
    }

    public function createdAt()
    {
        return $this->entity->created_at->diffForHumans();
    }
}