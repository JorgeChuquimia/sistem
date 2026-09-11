<?php

namespace App\Http\Requests\Rol;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_rol' => [
                'required',
                'string',
                'min:3',
                'max:13',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/',
                'unique:roles,nombre_rol'
            ],
        ];
    }
}
