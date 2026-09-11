<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Actions\User\CreateUserAction;
use App\Actions\User\UpdateUserAction;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::with('rol')->get();
        $roles = Role::all();
        return view('usuarios.index', compact('usuarios', 'roles'));
    }

    /**
     * Almacena un nuevo usuario.
     */
    public function store(StoreUserRequest $request, CreateUserAction $action)
    {
        $action->execute($request->validated());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario registrado exitosamente.');
    }

    /**
     * Actualiza un usuario existente (Sin alterar su rol).
     */
    public function update(UpdateUserRequest $request, $id, UpdateUserAction $action)
    {
        $usuario = User::findOrFail($id);

        $action->execute($usuario, $request->validated());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario del sistema de forma segura.
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        // Evitar que el administrador elimine su propia cuenta
        if (auth()->id() == $usuario->id_usuario) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No puedes eliminar tu propia cuenta de administrador.');
        }

        try {
            $usuario->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            // Captura errores de llave foránea si el usuario tiene registros en personas/docentes
            return redirect()->route('usuarios.index')
                ->with('error', 'No se puede eliminar este usuario porque tiene información de persona o docente vinculada.');
        }

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
