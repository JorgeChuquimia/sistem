<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('usuario') ?? $this->route('id');

        return [
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:usuarios,email,' . $userId . ',id_usuario'
            ],
            'password' => ['nullable', Rules\Password::defaults()],
        ];
    }
}
