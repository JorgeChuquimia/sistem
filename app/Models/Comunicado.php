<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    protected $table = 'comunicados';
    protected $primaryKey = 'id_comunicado';

    protected $fillable = [
        'comentario',
        'comunicado',
        'estado',
    ];
}
