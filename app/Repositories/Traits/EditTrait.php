<?php

namespace App\Repositories\Traits;

use App\Exceptions\NotFoundException;
use Spatie\QueryBuilder\QueryBuilder;
use App\Repositories\Traits\FindTrait as FindById;

trait EditTrait
{
    use FindById;

    public function update(string|int $id, array $data)
    {
        $resource = $this->find($id);

        $resource->update(array_filter($data, fn($field) => !empty($field)));
        $resource->refresh();

        return $resource;
    }
}
