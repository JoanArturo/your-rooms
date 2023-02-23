<?php namespace App\Interfaces;

interface RepositoryInterface
{
    public function getAll($paginate = false);
    public function getAllSort($sortColumn = 'created_at', $sortType = 'asc', $paginate = false);
    public function findById($id);
    public function delete($id);
    public function create(array $data);
    public function update($id, array $data);
}