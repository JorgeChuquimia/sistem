<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:usuarios'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Aquí agregamos explícitamente el rol_id por defecto para los registros públicos (ej. el ID 1 o 2 de tus roles)
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => 2, // <-- CAMBIA ESTE NÚMERO por el ID del rol que deseas asignar por defecto al registrarse
            'estado' => true,
        ]);

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
