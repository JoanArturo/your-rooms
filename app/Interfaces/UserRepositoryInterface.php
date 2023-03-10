<?php namespace App\Interfaces;

use Illuminate\Support\Collection;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAllRoles(): Collection;
    public function getAllAccountStatus(): Collection;
    public function updateIsBannedStatusFromUser($id, bool $status);
    public function updateProfilePictureFromUser($id, $file);
    public function deleteProfilePictureFromUser($id);
    public function updatePasswordFromUser($id, $newPassword);
}