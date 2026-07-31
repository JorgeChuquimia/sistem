<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Indicamos el nombre exacto de la tabla si difiere del plural por defecto
    protected $table = 'roles';

    // Indicamos cuál es la llave primaria personalizada
    protected $primaryKey = 'id_rol';

    // Campos que se pueden rellenar masivamente
    protected $fillable = ['nombre_rol', 'estado'];
    public function usuarios()
    {
        return $this->hasMany(User::class, 'rol_id', 'id_rol');
    }
}
