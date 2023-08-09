<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteRequest;
use App\Http\Resources\PacienteResource;
use App\Models\Paciente;
use App\Repositories\Contracts\PacienteRepositoryInterface;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function __construct(
        private PacienteRepositoryInterface $repository
    )
    {
        $this->middleware(['auth:api']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = $this->repository->paginate(
            perPage: request()->get('per_page', 15),
            page: \request()->get('page', 1)
        );

        return PacienteResource::collection($pacientes)->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PacienteRequest $request)
    {
        $paciente = $this->repository->insert($request->validated());

        return (new PacienteResource($paciente))->response()->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PacienteRequest $request, $pacienteId)
    {
        $paciente = $this->repository->update($pacienteId, $request->validated());

        return (new PacienteResource($paciente))->response();
    }

}
