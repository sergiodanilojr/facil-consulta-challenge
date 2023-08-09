<?php

namespace App\Repositories\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

trait PaginateTrait
{
    public function paginate(int $perPage = 15, int $page = 1):LengthAwarePaginator
    {
        return QueryBuilder::for($this->model)
            ->allowedFields((method_exists($this, 'getAllowedFields')) ? $this->allowedFields() : [])
            ->allowedIncludes((method_exists($this, 'getAllowedIncludes')) ? $this->getAllowedIncludes() : [])
            ->allowedSorts((method_exists($this, 'getAllowedSorts')) ? $this->allowedSorts() : [])
            ->allowedFilters((method_exists($this, 'getAllowedFilters')) ? $this->allowedFilters() : [])
            ->paginate(perPage: $perPage, page: $page)
            ->appends(request()->query());
    }
}
