<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::withoutMiddleware('auth:api')
        ->post('login', \App\Http\Controllers\Auth\LoginController::class);

    Route::post('logout', \App\Http\Controllers\Auth\LogoutController::class);
    Route::post('refresh', \App\Http\Controllers\Auth\RefreshTokenController::class);
    Route::get('user', \App\Http\Controllers\Auth\MeController::class);
});

Route::get('cidades', \App\Http\Controllers\CidadeController::class);
Route::get('cidades/{cidade}/medicos', \App\Http\Controllers\MedicosCidadeController::class);
Route::apiResource('medicos', \App\Http\Controllers\MedicoController::class)->only('index', 'store');

Route::apiResource('medicos/{medico}/pacientes', \App\Http\Controllers\MedicoPacienteController::class)
    ->only('index', 'store');
Route::apiResource('pacientes', \App\Http\Controllers\PacienteController::class)
    ->except('destroy');

