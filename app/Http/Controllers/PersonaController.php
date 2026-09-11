<?php

namespace App\Http\Controllers;

use App\Http\Requests\Persona\StorePersonaRequest;
use App\Http\Requests\Persona\UpdatePersonaRequest;
use App\Actions\Persona\CreatePersonaAction;
use App\Actions\Persona\UpdatePersonaAction;
use App\Models\Persona;
use App\Models\User;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::with('usuario')->get();

        // Usuarios libres para el formulario de CREAR
        $usuariosLibres = User::doesntHave('persona')->get();

        // Todos los usuarios por si se necesitan (o para el select de edición)
        $usuarios = User::all();

        return view('personas.index', compact('personas', 'usuariosLibres', 'usuarios'));
    }

    public function store(StorePersonaRequest $request, CreatePersonaAction $action)
    {
        $action->execute($request->validated());

        return redirect()->route('personas.index')
            ->with('success', 'Persona registrada correctamente.');
    }

    public function update(UpdatePersonaRequest $request, $id, UpdatePersonaAction $action)
    {
        $persona = Persona::findOrFail($id);

        $action->execute($persona, $request->validated());

        return redirect()->route('personas.index')
            ->with('success', 'Persona actualizada correctamente.');
    }

    public function destroy($id)
    {
        $persona = Persona::findOrFail($id);

        try {
            $persona->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('personas.index')
                ->with('error', 'No se puede eliminar esta persona porque tiene registros relacionados.');
        }

        return redirect()->route('personas.index')
            ->with('success', 'Persona eliminada correctamente.');
    }
}
