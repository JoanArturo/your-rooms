<?php namespace App\Repositories;

use App\Suggestion as Entity;
use App\Interfaces\SuggestionRepositoryInterface;

class SuggestionRepository implements SuggestionRepositoryInterface
{
    public function getAll($paginate = false)
    {
        if (request()->has('search')) {
            $search = request()->get('search');
            $entity = Entity::join('users', 'users.id', '=', 'suggestions.user_id')
                ->select('suggestions.*', 'users.name')
                ->where(function($query) use ($search) {
                    $query->where('suggestions.id', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");
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
            $entity = Entity::join('users', 'users.id', '=', 'suggestions.user_id')
                ->select('suggestions.*', 'users.name')
                ->where(function($query) use ($search) {
                    $query->where('suggestions.id', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");
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

        return $paginate ? Entity::orderBy($sortColumn, $sortType)->paginate() : Entity::orderBy($sortColumn, $sortType)->get();
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
        //
    }

    public function update($id, array $data)
    {
        //
    }
}