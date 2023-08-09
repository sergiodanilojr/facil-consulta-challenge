<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\BadRequestException;
use App\Models\Medico;
use App\Models\Paciente;
use App\Repositories\Contracts\CidadeRepositoryInterface;
use App\Repositories\Contracts\MedicoRepositoryInterface;
use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Repositories\Traits\AllTrait;
use App\Repositories\Traits\EditTrait;
use App\Repositories\Traits\FindTrait;
use App\Repositories\Traits\InsertTrait;
use App\Repositories\Traits\PaginateTrait;
use App\Repositories\Traits\QueryBuilder\HasFilters;
use App\Repositories\Traits\QueryBuilder\HasIncludes;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PacienteEloquentRepository implements PacienteRepositoryInterface
{
    use HasIncludes, HasFilters, PaginateTrait, FindTrait, EditTrait, InsertTrait;

    private $model = Paciente::class;

    protected array $allowedIncludes = ['medico', 'cidade'];
    protected array $allowedFilters = [];

    public function __construct(
        private CidadeRepositoryInterface $cidadeRepository,
        private MedicoRepositoryInterface $medicoRepository,
    )
    {
    }

    public function all()
    {
        return QueryBuilder::for($this->model)
            ->allowedFields((method_exists($this, 'getAllowedFields')) ? $this->getAllowedFields() : [])
            ->allowedIncludes(['cidade'])
            ->allowedSorts((method_exists($this, 'getAllowedSorts')) ? $this->getAllowedSorts() : [])
            ->allowedFilters((method_exists($this, 'getAllowedFilters')) ? $this->getAllowedFilters() : [])
            ->get();
    }

    public function paginate(int $perPage = 15, int $page = 1): LengthAwarePaginator
    {
        return QueryBuilder::for($this->model)
            ->allowedFields((method_exists($this, 'getAllowedFields')) ? $this->getAllowedFields() : [])
            ->allowedIncludes(['cidade'])
            ->allowedSorts((method_exists($this, 'getAllowedSorts')) ? $this->getAllowedSorts() : [])
            ->allowedFilters((method_exists($this, 'getAllowedFilters')) ? $this->getAllowedFilters() : [])
            ->paginate(perPage: $perPage, page: $page)
            ->appends(request()->query());
    }

    public function fetchByCidade($cidadeId, int $perPage = 15, int $page = 1)
    {
        $this->cidadeRepository->find($cidadeId);

        return QueryBuilder::for($this->model)
            ->fromCidade($cidadeId)
            ->paginate(perPage: $perPage, page: $page)
            ->appends(request()->query());
    }

    public function fetchByMedico($medicoId, int $perPage = 15, int $page = 1)
    {
        return QueryBuilder::for($this->model)
            ->whereHas('medico', function ($query) use ($medicoId) {
                $query->where('medico_id', $medicoId);
            })
            ->paginate(perPage: $perPage, page: $page)
            ->appends(request()->query());
    }
}
