<?php namespace App\Repositories;

use App\User as Entity;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function getAll($paginate = false)
    {
        if (request()->has('search')) {
            $search = request()->get('search');
            $entity = Entity::where(function($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
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
            $entity = Entity::where(function($query) use ($search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
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
        $entity = $this->findById($id);

        $entity->messages()->delete();

        $entity->rooms()->delete();
        
        $entity->suggestions()->delete();

        return $entity->delete();
    }

    public function create(array $data)
    {
        $data['is_admin'] = $data['role'] == 1;
        
        $data['is_banned'] = $data['account_status'] == 2;

        unset($data['role'], $data['account_status']);

        $data['password'] = Hash::make($data['password']);

        return Entity::create($data);
    }

    public function update($id, array $data)
    {
        $entity = $this->findById($id);

        $data['is_admin'] = $data['role'] == 1;
        
        $data['is_banned'] = $data['account_status'] == 2;

        unset($data['role'], $data['account_status']);

        return $entity->update($data);
    }

    public function getAllRoles(): \Illuminate\Support\Collection
    {
        return collect([
            1 => __('Administrator'),
            2 => __('User')
        ]);
    }

    public function getAllAccountStatus(): \Illuminate\Support\Collection
    {
        return collect([
            1 => __('Active'),
            2 => __('Banned')
        ]);
    }

    public function updateIsBannedStatusFromUser($id, bool $status)
    {
        $entity = $this->findById($id);

        $entity->is_banned = $status;

        return $entity->save();
    }
}