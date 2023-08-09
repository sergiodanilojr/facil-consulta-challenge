<?php

namespace App\Repositories\Eloquent;

use App\Models\Cidade;
use App\Repositories\Contracts\CidadeRepositoryInterface;
use App\Repositories\Traits\AllTrait;
use App\Repositories\Traits\FindTrait;
use App\Repositories\Traits\QueryBuilder\HasIncludes;

class CidadeEloquentRepository implements CidadeRepositoryInterface
{
    use AllTrait, FindTrait, HasIncludes;

    private $model = Cidade::class;

    protected array $allowedIncludes = ['medicos.pacientes'];

}
