<?php

namespace App\Http\Requests\Traits;

trait RequirableTrait
{
    /**
     * @return bool
     */
    private function isUpdating():bool
    {
        return in_array($this->method(), ['PUT', 'PATCH']);
    }

    /**
     * @return string
     */
    private function requirable():string
    {
        return $this->isUpdating() ? 'filled' : 'required';
    }

    private function nullable():string
    {
        return $this->isUpdating() ? 'filled' : 'nullable';
    }
}
