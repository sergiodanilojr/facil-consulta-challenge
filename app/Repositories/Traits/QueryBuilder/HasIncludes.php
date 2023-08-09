<?php

namespace App\Repositories\Traits\QueryBuilder;

trait HasIncludes
{
    protected function getAllowedIncludes()
    {
        return property_exists($this, 'allowedIncludes') ? $this->allowedIncludes : [];
    }
}
