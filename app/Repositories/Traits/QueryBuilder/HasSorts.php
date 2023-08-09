<?php

namespace App\Repositories\Traits\QueryBuilder;

trait HasSorts
{
    protected function getAllowedSorts()
    {
        return property_exists($this, 'allowedSorts') ? $this->allowedSorts : [];
    }
}
