<?php

namespace App\Http\Controllers;

use App\Http\Resources\CidadeResource;
use App\Models\Cidade;
use App\Repositories\Contracts\CidadeRepositoryInterface;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function __construct(
        private CidadeRepositoryInterface $repository,
    )
    {
    }

    public function __invoke()
    {
        $cidades = $this->repository->all();

        return CidadeResource::collection($cidades)->response();
    }
}
