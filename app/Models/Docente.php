<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docentes';
    protected $primaryKey = 'id_docente';

    protected $fillable = [
        'persona_id',
        'especialidad',
        'antiguedad',
        'rda',
        'estado',
    ];
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id_persona');
    }
}
