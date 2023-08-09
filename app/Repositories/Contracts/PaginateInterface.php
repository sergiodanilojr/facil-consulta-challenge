<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface PaginateInterface
{
    public function paginate(int $perPage = 15, int $page= 1):LengthAwarePaginator;
}
