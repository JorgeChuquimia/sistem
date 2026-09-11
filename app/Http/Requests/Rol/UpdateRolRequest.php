<?php

namespace App\Http\Requests\Rol;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roleId = $this->route('rol') ?? $this->route('id');

        return [
            'nombre_rol' => [
                'required',
                'string',
                'min:3',
                'max:13',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/',
                'unique:roles,nombre_rol,' . $roleId . ',id_rol'
            ],
        ];
    }
}
