<?php

namespace App\Actions\Rol;

use App\Models\Role;

class UpdateRolAction
{
    public function execute(Role $role, array $data): Role
    {
        $role->update([
            'nombre_rol' => mb_strtoupper($data['nombre_rol'], 'UTF-8'),
        ]);

        return $role;
    }
}
