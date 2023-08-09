<?php

namespace App\Repositories\Contracts;

interface MedicoRepositoryInterface extends PaginateInterface, FetchResultsInterface, InsertInterface, EditInterface
{
    public function fetchByCidade($cityId);

    public function addPaciente(string|int $medicoId, string|int $pacienteId);

    public function pacientes(string|int $medicoId, int $perPage, int $page);
}
