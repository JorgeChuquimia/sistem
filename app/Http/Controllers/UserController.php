<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    // Mostrar lista de usuarios junto con sus roles
    public function index()
    {
        $usuarios = User::with('rol')->get();
        $roles = Role::all(); // Para llenar los selectores en las vistas/modales
        return view('usuarios.index', compact('usuarios', 'roles'));
    }

    // Guardar un nuevo usuario creado por el Administrador
    public function store(Request $request)
    {
        $request->validate([
            'rol_id' => 'required|exists:roles,id_rol',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => ['required', Rules\Password::defaults()],
        ]);

        User::create([
            'rol_id' => $request->rol_id,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Cifrado seguro de contraseña
            'estado' => true,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado exitosamente.');
    }

    // Actualizar datos del usuario
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'rol_id' => 'required|exists:roles,id_rol',
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . $id . ',id_usuario',
            'password' => ['nullable', Rules\Password::defaults()],
        ]);

        $usuario->rol_id = $request->rol_id;
        $usuario->email = $request->email;

        // Si el administrador ingresó una nueva contraseña, la actualizamos cifrada
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        // Opcional: Evitar que el admin se elimine a sí mismo
        if (auth()->id() == $usuario->id_usuario) {
            return redirect()->route('usuarios.index')->with('error', 'No puedes eliminar tu propia cuenta de administrador.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
