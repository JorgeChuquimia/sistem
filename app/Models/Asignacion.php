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
    public function docente()
    {
        return $this->belongsTo(Docente::class, 'docente_id', 'id_docente');
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'nivel_id', 'id_nivel');
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'grado_id', 'id_grado');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id', 'id_materia');
    }
}
