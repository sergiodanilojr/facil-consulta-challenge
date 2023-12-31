<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CidadeResource extends JsonResource
{
    public static $wrap = null;

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
            'estado' => $this->estado,
            'medicos' => $this->whenLoaded(
                'medicos', fn() => MedicoResource::collection($this->medicos)
            ),
            'medicos_count' => $this->whenCounted('medicos', fn() => $this->medicos_count)
        ];
    }
}
