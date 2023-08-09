<?php

namespace App\Repositories\Traits;

use App\Exceptions\NotFoundException;
use Spatie\QueryBuilder\QueryBuilder;

trait FindTrait
{
    public function find(string|int $id)
    {
        return QueryBuilder::for($this->model)
            ->allowedFields((method_exists($this, 'getAllowedFields')) ? $this->getAllowedFields() : [])
            ->allowedIncludes((method_exists($this, 'getAllowedIncludes')) ? $this->getAllowedIncludes() : [])
            ->allowedSorts((method_exists($this, 'getAllowedSorts')) ? $this->getAllowedSorts() : [])
            ->allowedFilters((method_exists($this, 'getAllowedFilters')) ? $this->getAllowedFilters() : [])
            ->findOr($id, fn() => throw new NotFoundException());
    }
}
