<?php

namespace App\Repositories\Contracts;

interface FindInterface
{
    public function find(string|int $id);
}
