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
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id', 'id_docente');
    }

    public function estudiante()
    {
        return $this->belongsTo(Student::class, 'estudiante_id', 'id_estudiante');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id', 'id_materia');
    }
    public function scopeFiltrarPorRol($query, $user)
    {
        // Si el rol es Administrador (asumiendo que id_rol == 1 es Administrador)
        if ($user->rol_id == 1) {
            return $query;
        }

        // Si es Docente (asumiendo que id_rol == 2 es Docente)
        if ($user->rol_id == 2 && $user->docente) {
            return $query->where('docente_id', $user->docente->id_docente);
        }

        return $query;
    }
}
