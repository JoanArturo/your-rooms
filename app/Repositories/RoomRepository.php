<?php namespace App\Repositories;

use App\Room as Entity;
use App\Interfaces\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    public function getAll($paginate = false)
    {
        if (request()->has('search')) {
            $search = request()->get('search');
            $entity= Entity::with('users')->where(function($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
                }
            );
            
            return $paginate ? $entity->paginate() : $entity->get();
        }

        return $paginate ?
            Entity::with('users')->paginate() :
            Entity::with('users')->all();
    }

    public function getAllSort($sortColumn = 'created_at', $sortType = 'asc', $paginate = false)
    {
        if (request()->has('search')) {
            $search = request()->get('search');
            $entity= Entity::with('users')->where(function($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
                }
            );

            return $paginate ? 
                $entity
                    ->orderBy($sortColumn, $sortType)
                    ->paginate() : 
                $entity
                    ->orderBy($sortColumn, $sortType)
                    ->get();
        }

        return $paginate ?
            Entity::with('users')->orderBy($sortColumn, $sortType)->paginate() :
            Entity::with('users')->orderBy($sortColumn, $sortType)->all();
    }
    
    public function getAllActiveRooms($paginate = false)
    {
        $entity = Entity::with('users');

        if (request()->has('search')) {
            $search = request()->get('search');
            $entity->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
                }
            );
        }

        return $paginate ?
            $entity->latest()->whereActive(1)->paginate() :
            $entity->latest()->whereActive(1)->get();
    }

    public function findById($id, $onlyActivated = false)
    {
        return $onlyActivated ?
            Entity::with(['users', 'messages', 'messages.user'])->whereId($id)->whereActive(1)->firstOrFail() :
            Entity::with(['users', 'messages', 'messages.user'])->findOrFail($id);
    }

    public function delete($id)
    {
        $room = $this->findById($id);
        
        $room->messages()->delete();

        $room->users()->detach();
        
        return $room->delete();
    }

    public function create(array $data)
    {
        return Entity::create($data);
    }

    public function update($id, array $data)
    {
        $room = $this->findById($id);

        if (empty($data['active']))
            $data['active'] = 0;

        return $room->update($data);
    }

    public function createMessage($id, $userId, $message)
    {
        $room = $this->findById($id, true);

        $message = $room->messages()->create([
            'body'    => $message,
            'user_id' => $userId
        ]);

        return $message->load(['user', 'room']);
    }

    public function removeUserFromARoom($userId, $roomId)
    {
        $room = $this->findById($roomId);

        $room->users()->detach($userId);
    }

    public function joinUserARandomRoom($userId)
    {
        $rooms = Entity::whereDoesntHave('users', function ($query) use ($userId) {
            $query->whereUserId($userId);
        })->get();

        if ($rooms->count() <= 0)
            return null;

        $room = $rooms->random();

        if ($room->users->count() >= $room->limit)
            return null;
        
        $room->users()->attach($userId);

        return $room;
    }
}