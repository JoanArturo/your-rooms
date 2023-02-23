<?php namespace App\Presenters;

use Illuminate\Database\Eloquent\Model;

abstract class Presenter
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }
}