<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $personaId = $this->route('persona') ?? $this->route('id');

        return [
            'nombres' => ['required', 'string', 'max:50'],
            'apellidos' => ['required', 'string', 'max:50'],
            'ci' => ['required', 'string', 'max:20', 'unique:personas,ci,' . $personaId . ',id_persona'],
            'fecha_nacimiento' => ['required', 'string', 'max:20'],
            'profesion' => ['required', 'string', 'max:50'],
            'direccion' => ['required', 'string', 'max:255'],
            'celular' => ['required', 'string', 'max:20', 'unique:personas,celular,' . $personaId . ',id_persona'],
        ];
    }
}
