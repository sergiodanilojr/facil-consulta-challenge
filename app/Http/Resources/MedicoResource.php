<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'especialidade' => $this->especialidade,
            'cidade_id' => $this->cidade_id,
            'cidade' => $this->whenLoaded(
                'cidade',
                fn() => new CidadeResource($this->cidade)
            ),
            'pacientes' => $this->whenLoaded(
                'pacientes',
                fn() => PacienteResource::collection($this->pacientes)
            ),
            'pacientes_count' => $this->whenCounted(
                'pacientes',
                fn() => $this->pacientes_count
            )
        ];
    }
}
