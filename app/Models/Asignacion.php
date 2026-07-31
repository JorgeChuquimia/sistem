<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'asignaciones';
    protected $primaryKey = 'id_asignacion';

    protected $fillable = [
        'docente_id',
        'nivel_id',
        'grado_id',
        'materia_id',
        'estado',
    ];
}
