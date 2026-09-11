<?php

namespace App\Actions\Rol;

use App\Models\Role;
use Illuminate\Validation\ValidationException;

class DeleteRolAction
{
    public function execute(Role $role): bool
    {
        if ($role->usuarios()->exists()) {
            throw ValidationException::withMessages([
                'delete_error' => 'No se puede eliminar este rol porque ya está asignado a uno o más usuarios.'
            ]);
        }

        return $role->delete();
    }
}
