<?php namespace App\Interfaces;

use Illuminate\Support\Collection;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAllRoles(): Collection;
    public function getAllAccountStatus(): Collection;
}