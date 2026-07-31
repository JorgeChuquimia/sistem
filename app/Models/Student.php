<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'estudiantes';
    protected $primaryKey = 'id_estudiante';

    protected $fillable = [
        'persona_id',
        'nivel_id',
        'grado_id',
        'rude',
        'estado',
    ];
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id_persona');
    }
}
