<?php

namespace App\Providers;

use App\Repositories\Contracts\CidadeRepositoryInterface;
use App\Repositories\Contracts\MedicoRepositoryInterface;
use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Repositories\Eloquent\CidadeEloquentRepository;
use App\Repositories\Eloquent\MedicoEloquentRepository;
use App\Repositories\Eloquent\PacienteEloquentRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class FacilConsultaServiceProvider extends ServiceProvider
{
    private array $repositories = [
        CidadeRepositoryInterface::class => CidadeEloquentRepository::class,
        MedicoRepositoryInterface::class => MedicoEloquentRepository::class,
        PacienteRepositoryInterface::class => PacienteEloquentRepository::class
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        collect($this->repositories)
            ->each(
                fn($concrete, $abstract) => $this->app->bind($abstract, $concrete)
            );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
    }
}
