<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'id_persona';

    protected $fillable = [
        'usuario_id',
        'nombres',
        'apellidos',
        'ci',
        'fecha_nacimiento',
        'profesion',
        'direccion',
        'celular',
        'estado',
    ];
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id_usuario');
    }
    public function docente()
    {
        return $this->hasOne(Docente::class, 'persona_id', 'id_persona');
    }

    public function estudiante()
    {
        return $this->hasOne(Student::class, 'persona_id', 'id_persona');
    }
}
