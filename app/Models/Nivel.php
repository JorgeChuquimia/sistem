<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'niveles';
    protected $primaryKey = 'id_nivel';

    protected $fillable = [
        'gestion_id',
        'nivel',
        'turno',
        'estado',
    ];
}
