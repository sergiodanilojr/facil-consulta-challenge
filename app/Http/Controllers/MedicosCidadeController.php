<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedicoResource;
use App\Repositories\Contracts\MedicoRepositoryInterface;
use Illuminate\Http\Request;

class MedicosCidadeController extends Controller
{
    public function __construct(
        private MedicoRepositoryInterface $repository,
    )
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke($cidadeId)
    {
        $medicos = $this->repository->fetchByCidade(
            cidadeId: $cidadeId,
            perPage: request()->query('per_page',15),
            page: request()->query('page', 1)
        );

        return MedicoResource::collection($medicos)->response();
    }
}
