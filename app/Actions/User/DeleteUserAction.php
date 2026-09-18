<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Validation\ValidationException;

class DeleteUserAction
{
    public function execute(User $user): bool
    {
        // 1. Evitar que el administrador elimine su propia cuenta
        if (auth()->id() == $user->id_usuario) {
            throw ValidationException::withMessages([
                'delete_error' => 'No puedes eliminar tu propia cuenta de administrador.'
            ]);
        }

        // 2. Validar si el usuario está asignado a una persona (integridad de datos)
        if ($user->persona()->exists()) {
            throw ValidationException::withMessages([
                'delete_error' => 'No se puede eliminar este usuario porque ya tiene una persona asignada.'
            ]);
        }

        return $user->delete();
    }
}