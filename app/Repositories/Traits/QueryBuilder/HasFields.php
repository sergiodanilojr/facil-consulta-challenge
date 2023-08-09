<?php

namespace App\Repositories\Traits\QueryBuilder;

trait HasFields
{
    protected function getAllowedFields()
    {
        return property_exists($this, 'allowedFields') ? $this->allowedFields : [];
    }
}
