<?php

namespace App\Repositories\Contracts;

interface EditInterface
{
    public function update(string | int $id, array $data);
}
