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

    // Relaciones del modelo
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

    // Scope para filtrar las asistencias de forma segura por el NOMBRE del rol
    public function scopeFiltrarPorRol($query, $user)
    {
        // Evaluamos con nombre_rol según tu modelo Role
        if ($user->rol && $user->rol->nombre_rol === 'Administrador') {
            return $query;
        }

        if ($user->rol && $user->rol->nombre_rol === 'Docente' && $user->docente) {
            return $query->where('docente_id', $user->docente->id_docente);
        }

        return $query;
    }
}
