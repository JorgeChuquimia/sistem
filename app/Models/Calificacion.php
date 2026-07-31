<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 'calificaciones';
    protected $primaryKey = 'id_calificacion';

    protected $fillable = [
        'docente_id',
        'estudiante_id',
        'materia_id',
        'nota1',
        'nota2',
        'nota3',
        'estado',
    ];
}
