<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePacienteRequest;
use App\Http\Resources\MedicoResource;
use App\Http\Resources\PacienteResource;
use App\Repositories\Contracts\MedicoRepositoryInterface;

class MedicoPacienteController extends Controller
{
    public function __construct(
        private MedicoRepositoryInterface $repository
    )
    {
        $this->middleware(['auth:api']);
    }

    public function index($medicoId)
    {
        $pacientes = $this->repository->pacientes(
            medicoId: $medicoId,
            perPage:request()->query('per_page', 15),
            page: request()->query('page', 1)
        );
        return PacienteResource::collection($pacientes)->response();
    }

    public function store(StorePacienteRequest $request, $medicoId)
    {
        $medico = $this->repository->addPaciente(
            medicoId: $medicoId,
            pacienteId: $request->validated('paciente_id')
        );

        return (new MedicoResource($medico))->response();
    }
}
