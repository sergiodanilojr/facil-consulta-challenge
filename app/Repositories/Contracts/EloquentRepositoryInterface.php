<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface EloquentRepositoryInterface
{
    public function all();



    public function find($id);

    public function delete();

    public function update($id, array $data);
}
