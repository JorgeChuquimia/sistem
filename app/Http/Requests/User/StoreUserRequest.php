<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUserRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta petición.
     */
    public function authorize(): bool
    {
        return true; // Cambiado a true para permitir la ejecución de la petición
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Validamos que el rol exista en tu tabla 'roles' usando tu llave primaria 'id_rol'
            'rol_id' => ['required', 'exists:roles,id_rol'],

            // Validamos el correo asegurando que sea único en tu tabla personalizada 'usuarios'
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:usuarios,email'
            ],

            // Validamos la contraseña con los estándares seguros de Laravel
            'password' => ['required', Rules\Password::defaults()],
        ];
    }
}
