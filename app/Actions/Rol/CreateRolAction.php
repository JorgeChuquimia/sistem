<?php

namespace App\Actions\Rol;

use App\Models\Role;

class CreateRolAction
{
    public function execute(array $data): Role
    {
        return Role::create([
            'nombre_rol' => mb_strtoupper($data['nombre_rol'], 'UTF-8'),
            'estado' => true,
        ]);
    }
}
