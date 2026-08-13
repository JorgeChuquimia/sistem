<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RolController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_rol' => 'required|string|max:50|unique:roles,nombre_rol',
        ]);

        Role::create([
            'nombre_rol' => mb_strtoupper($request->nombre_rol, 'UTF-8'),
            'estado' => true,
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'nombre_rol' => 'required|string|max:50|unique:roles,nombre_rol,' . $id . ',id_rol',
        ]);

        $role->update([
            'nombre_rol' => mb_strtoupper($request->nombre_rol, 'UTF-8'),
        ]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }
}
