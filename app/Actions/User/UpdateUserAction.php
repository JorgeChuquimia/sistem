<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UpdateUserAction
{
    public function execute(User $user, array $data): User
    {
        return DB::transaction(function () use ($user, $data) {

            // Como el select está disabled, por defecto el navegador NUNCA envía 'rol_id'.
            // Si 'rol_id' está presente en la petición, significa 100% que quitaron el disabled en el DOM.
            if (request()->has('rol_id')) {
                throw ValidationException::withMessages([
                    'rol_id' => 'El rol del usuario no se puede modificar por el DOM.'
                ]);
            }

            $user->email = $data['email'];

            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }

            $user->save();

            return $user;
        });
    }
}
