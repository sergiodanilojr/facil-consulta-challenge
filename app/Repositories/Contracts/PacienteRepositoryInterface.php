<?php

namespace App\Repositories\Contracts;

interface PacienteRepositoryInterface extends PaginateInterface, FetchResultsInterface, InsertInterface, EditInterface
{
    public function fetchByMedico($medicoId);

}
