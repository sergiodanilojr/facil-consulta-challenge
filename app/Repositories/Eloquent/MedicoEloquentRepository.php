<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\BadRequestException;
use App\Models\Medico;
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

class MedicoEloquentRepository implements MedicoRepositoryInterface
{
    use HasIncludes, HasFilters, PaginateTrait, FindTrait, EditTrait, InsertTrait;

    private $model = Medico::class;

    protected array $allowedIncludes = ['pacientes.cidade', 'pacientes_count', 'cidade'];
    protected array $allowedFilters = [];

    public function __construct(
        private CidadeRepositoryInterface $cidadeRepository
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

    public function addPaciente(string|int $medicoId, string|int $pacienteId)
    {
        $model = new Medico();

        $medico = $model
//            ->where(function ($query) use ($pacienteId) {
//                $query->whereDoesntHave('medicoPacientes', function ($query) use ($pacienteId) {
//                    $query->where('paciente_id', $pacienteId);
//                })->orWhereHas('medicoPacientes', function ($query) use ($pacienteId) {
//                        $query->where('paciente_id', "!=", $pacienteId);
//                    });
//            })
            ->whereDoesntHave('pacientes', function ($query) use ($pacienteId) {
                $query->where('pacientes.id', $pacienteId);
            })
            ->findOr(
                $medicoId,
                fn() => throw new BadRequestException("Este Paciente já está vinculado ou o médico não existe.")
            );

        $medico->medicoPacientes()->create(['paciente_id' => $pacienteId]);

        return $medico->load(['pacientes' => function ($query) use ($pacienteId) {
            $query->where('id', $pacienteId);
        }]);
    }

    public function pacientes(string|int $medicoId, int $perPage, int $page)
    {
        $pacienteRepository = app(PacienteRepositoryInterface::class);

        return $pacienteRepository->fetchByMedico($medicoId, $perPage, $page);
    }
}
