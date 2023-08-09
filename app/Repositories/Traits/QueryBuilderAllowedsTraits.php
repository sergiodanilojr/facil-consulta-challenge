<?php

namespace App\Repositories\Traits;

use App\Repositories\Traits\QueryBuilder\HasFields;
use App\Repositories\Traits\QueryBuilder\HasFilters;
use App\Repositories\Traits\QueryBuilder\HasIncludes;
use App\Repositories\Traits\QueryBuilder\HasSorts;

trait QueryBuilderAllowedsTraits
{
    use HasIncludes, HasSorts, HasFilters, HasFields;
}
