<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medico extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'especialidade',
        'cidade_id',
    ];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

    public function pacientes()
    {
        return $this->hasManyThrough(
            Paciente::class,
            MedicoPaciente::class,
            'medico_id','pacientes.id'
        );
    }

    public function medicoPacientes():HasMany
    {
        return $this->hasMany(MedicoPaciente::class,'medico_id');
    }



    public function scopeFromCidade($query, $cidadeId)
    {
        return $query->where('cidade_id', $cidadeId);
    }
}
