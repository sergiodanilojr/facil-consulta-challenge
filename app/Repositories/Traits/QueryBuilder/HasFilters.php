<?php

namespace App\Repositories\Traits\QueryBuilder;

trait HasFilters
{
    protected function getAllowedFilters()
    {
        return property_exists($this, 'allowedFilters') ? $this->allowedFilters : [];
    }
}
