<?php namespace App\Interfaces;

interface RoomRepositoryInterface extends RepositoryInterface
{
    public function createMessage($id, $userId, $message);
    public function removeUserFromARoom($userId, $roomId);
}