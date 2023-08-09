<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'cpf',
        'celular',
    ];

    public function medico()
    {
//        return $this->hasOneThrough(
//            Medico::class,
//            MedicoPaciente::class,
//            'medico_id',
//            'paciente_id'
//        )->latest();

        return $this->belongsTo(
            MedicoPaciente::class,
            'id',
            'paciente_id',
            Medico::class

        );
    }

    public function medicos()
    {
        return $this->hasManyThrough(
            Medico::class,
            MedicoPaciente::class
        );
    }

    public function cpf(): Attribute
    {
        return Attribute::set(fn($cpf) => preg_replace('/[^0-9]/', '', $cpf));
    }

    public function celular(): Attribute
    {
        return Attribute::set(fn($celular) => preg_replace('/[^0-9]/', '', $celular));
    }
}
