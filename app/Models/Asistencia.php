<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencias';
    protected $primaryKey = 'id_asistencia';

    protected $fillable = [
        'docente_id',
        'estudiante_id',
        'materia_id',
        'fecha',
        'observacion',
        'estado',
    ];
}
