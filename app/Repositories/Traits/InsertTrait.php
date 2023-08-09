<?php

namespace App\Repositories\Traits;

use App\Exceptions\NotFoundException;
use Spatie\QueryBuilder\QueryBuilder;

trait InsertTrait
{
    public function insert(array $data)
    {
        return QueryBuilder::for($this->model)
            ->allowedFields((method_exists($this, 'getAllowedFields')) ? $this->getAllowedFields() : [])
            ->allowedIncludes((method_exists($this, 'getAllowedIncludes')) ? $this->getAllowedIncludes() : [])
            ->allowedSorts((method_exists($this, 'getAllowedSorts')) ? $this->getAllowedSorts() : [])
            ->allowedFilters((method_exists($this, 'getAllowedFilters')) ? $this->getAllowedFilters() : [])
            ->create($data);
    }
}
