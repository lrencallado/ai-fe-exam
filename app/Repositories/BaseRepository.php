<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public function __construct(protected Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function get()
    {
        return $this->model->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data = [])
    {
        return $this->model->create($data);
    }
}
