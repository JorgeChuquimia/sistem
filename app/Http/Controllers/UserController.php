<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Actions\User\CreateUserAction;
use App\Actions\User\UpdateUserAction;
use App\Actions\User\DeleteUserAction;
use App\Models\User;
use App\Models\Role;
use Illuminate\Validation\ValidationException;

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
        $usuario = User::where('id_usuario', $id)->firstOrFail();

        $action->execute($usuario, $request->validated());

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Elimina un usuario del sistema de forma segura.
     */
    public function destroy($id, DeleteUserAction $action)
    {
        $usuario = User::where('id_usuario', $id)->firstOrFail();

        try {
            $action->execute($usuario);

            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario eliminado correctamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }
}
