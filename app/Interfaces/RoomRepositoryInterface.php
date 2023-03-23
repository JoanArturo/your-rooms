<?php namespace App\Interfaces;

interface RoomRepositoryInterface extends RepositoryInterface
{
    public function findById($id, $onlyActivated = false);
    public function createMessage($id, $userId, $message);
    public function removeUserFromARoom($userId, $roomId);
    public function getAllActiveRooms($paginate = false);
}