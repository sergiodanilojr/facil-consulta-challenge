<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicoRequest;
use App\Http\Resources\MedicoResource;
use App\Models\Medico;
use App\Repositories\Contracts\MedicoRepositoryInterface;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function __construct(
        private MedicoRepositoryInterface $repository,
    )
    {
        $this->middleware(['auth:api'], ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicos = $this->repository->paginate(
            perPage: request()->query('per_page', 15),
            page: request()->query('page', 1),
        );

        return MedicoResource::collection($medicos)->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicoRequest $request)
    {
        $medico = $this->repository->insert($request->validated());

        return (new MedicoResource($medico))->response();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $medico = $this->repository->find($id);

        return (new MedicoResource($medico))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medico $medico)
    {
        //
    }

}
