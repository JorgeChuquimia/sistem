<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\Rol\StoreRolRequest;
use App\Http\Requests\Rol\UpdateRolRequest;
use App\Actions\Rol\CreateRolAction;
use App\Actions\Rol\UpdateRolAction;
use App\Actions\Rol\DeleteRolAction;
use Illuminate\Validation\ValidationException;

class RolController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function store(StoreRolRequest $request, CreateRolAction $action)
    {
        $action->execute($request->validated());

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function update(UpdateRolRequest $request, $id, UpdateRolAction $action)
    {

        $role = Role::where('id_rol', $id)->firstOrFail();

        $action->execute($role, $request->validated());

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    public function destroy($id, DeleteRolAction $action)
    {
        $role = Role::where('id_rol', $id)->firstOrFail();

        try {
            $action->execute($role);

            return redirect()->route('roles.index')
                ->with('success', 'Rol eliminado exitosamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }
}
