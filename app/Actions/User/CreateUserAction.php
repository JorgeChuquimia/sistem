<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    /**
     * Ejecuta la lógica de negocio para registrar un nuevo usuario de forma segura.
     */
    public function execute(array $data): User
    {
        // Envolvemos la creación en una transacción de base de datos
        return DB::transaction(function () use ($data) {
            return User::create([
                'rol_id' => $data['rol_id'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'estado' => true,
            ]);
        });
    }
}
