<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::with('usuario')->get();
        $usuarios = User::all(); // Para asociar la persona a un usuario existente si es necesario
        return view('personas.index', compact('personas', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id_usuario',
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'ci' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|string|max:20',
            'profesion' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
        ]);

        Persona::create([
            'usuario_id' => $request->usuario_id,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'ci' => $request->ci,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'profesion' => $request->profesion,
            'direccion' => $request->direccion,
            'celular' => $request->celular,
            'estado' => true,
        ]);

        return redirect()->route('personas.index')->with('success', 'Persona registrada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $persona = Persona::findOrFail($id);

        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id_usuario',
            'nombres' => 'required|string|max:50',
            'apellidos' => 'required|string|max:50',
            'ci' => 'required|string|max:20',
            'fecha_nacimiento' => 'required|string|max:20',
            'profesion' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
        ]);

        $persona->update([
            'usuario_id' => $request->usuario_id,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'ci' => $request->ci,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'profesion' => $request->profesion,
            'direccion' => $request->direccion,
            'celular' => $request->celular,
        ]);

        return redirect()->route('personas.index')->with('success', 'Persona actualizada correctamente.');
    }

    public function destroy($id)
    {
        $persona = Persona::findOrFail($id);
        $persona->delete();

        return redirect()->route('personas.index')->with('success', 'Persona eliminada correctamente.');
    }
}
