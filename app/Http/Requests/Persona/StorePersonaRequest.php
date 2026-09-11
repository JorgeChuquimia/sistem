<?php

namespace App\Http\Requests\Persona;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'usuario_id' => ['required', 'exists:usuarios,id_usuario', 'unique:personas,usuario_id'],
            'nombres' => ['required', 'string', 'max:50'],
            'apellidos' => ['required', 'string', 'max:50'],
            'ci' => ['required', 'string', 'max:20', 'unique:personas,ci'],
            'fecha_nacimiento' => ['required', 'string', 'max:20'],
            'profesion' => ['required', 'string', 'max:50'],
            'direccion' => ['required', 'string', 'max:255'],
            'celular' => ['required', 'string', 'max:20', 'unique:personas,celular'],
        ];
    }
}
