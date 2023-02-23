<?php namespace App\Repositories;

use App\Room as Entity;
use App\Interfaces\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    public function getAll($paginate = false)
    {
        if (request()->has('search')) {
            $search = request()->get('search');
            $entity= Entity::where(function($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
                }
            );
            
            return $paginate ? $entity->paginate() : $entity->get();
        }

        return $paginate ? Entity::paginate() : Entity::all();
    }

    public function getAllSort($sortColumn = 'created_at', $sortType = 'asc', $paginate = false)
    {
        if (request()->has('search')) {
            $search = request()->get('search');
            $entity= Entity::where(function($query) use ($search) {
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

        return $paginate ? Entity::orderBy($sortColumn, $sortType)->paginate() : Entity::orderBy($sortColumn, $sortType)->all();
    }

    public function findById($id)
    {
        return Entity::findOrFail($id);
    }

    public function delete($id)
    {
        //
    }

    public function create(array $data)
    {
        return Entity::create($data);
    }

    public function update($id, array $data)
    {
        //
    }
}