<?php namespace App\Repositories;

use App\Report as Entity;
use App\Interfaces\ReportRepositoryInterface;

class ReportRepository implements ReportRepositoryInterface
{
    public function getAll($paginate = false)
    {
        if (request()->has('search')) {
            $search = request()->get('search');
            $entity = Entity::with(['user', 'message.user', 'message.user.messages.reports', 'message.room'])
                ->join('messages', 'messages.id', '=', 'reports.message_id')
                ->join('users', 'users.id', '=', 'messages.user_id')
                ->select('reports.*', 'users.name', 'messages.body')
                ->where(function($query) use ($search) {
                    $query->where('reports.id', 'like', "%{$search}%")
                        ->orWhere('users.name', 'like', "%{$search}%")
                        ->orWhere('messages.body', 'like', "%{$search}%");
                    }
                );
            
            return $paginate ? $entity->paginate() : $entity->get();
        }

        return $paginate ? 
            Entity::with(['user', 'message.user', 'message.user.messages.reports', 'message.room'])
                ->paginate() : 
            Entity::with(['user', 'message.user', 'message.user.messages.reports', 'message.room'])
                ->all();
    }

    public function getAllSort($sortColumn = 'created_at', $sortType = 'asc', $paginate = false)
    {
        if (request()->has('search')) {
            $search = request()->get('search');
            $entity = Entity::with(['user', 'message.user', 'message.user.messages.reports', 'message.room'])
                ->join('messages', 'messages.id', '=', 'reports.message_id')
                ->join('users', 'users.id', '=', 'messages.user_id')
                ->select('reports.*', 'users.name', 'messages.body')
                ->where(function($query) use ($search) {
                    $query->where('reports.id', 'like', "%{$search}%")
                        ->orWhere('users.name', 'like', "%{$search}%")
                        ->orWhere('messages.body', 'like', "%{$search}%");
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
            Entity::with(['user', 'message.user', 'message.user.messages.reports', 'message.room'])
                ->orderBy($sortColumn, $sortType)
                ->paginate() : 
            Entity::with(['user', 'message.user', 'message.user.messages.reports', 'message.room'])
                ->orderBy($sortColumn, $sortType)
                ->get();
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