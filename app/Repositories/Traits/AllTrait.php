<?php

namespace App\Repositories\Traits;

use Spatie\QueryBuilder\QueryBuilder;

trait AllTrait
{
    public function all()
    {
        return QueryBuilder::for($this->model)
            ->allowedFields((method_exists($this, 'getAllowedFields'))?$this->allowedFields():[])
            ->allowedIncludes((method_exists($this, 'getAllowedIncludes'))?$this->getAllowedIncludes():[])
            ->allowedSorts((method_exists($this, 'getAllowedSorts'))?$this->allowedSorts():[])
            ->allowedFilters((method_exists($this, 'getAllowedFilters'))?$this->allowedFilters():[])
            ->get();
    }
}
