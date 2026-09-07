<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Nivel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GradoController extends Controller
{
    public function index()
    {
        $grados = Grado::with('nivel.gestion')->get();
        $niveles = Nivel::with('gestion')->get();
        return view('grados.index', compact('grados', 'niveles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nivel_id' => 'required|exists:niveles,id_nivel',
            'curso' => [
                'required',
                'string',
                'max:100',
                // Validamos que la combinación de nivel, curso y paralelo sea única
                Rule::unique('grados')->where(function ($query) use ($request) {
                    return $query->where('nivel_id', $request->nivel_id)
                        ->where('paralelo', $request->paralelo);
                }),
            ],
            'paralelo' => 'required|string|max:50',
        ], [
            'curso.unique' => 'Ya existe un curso con este mismo paralelo registrado para el nivel seleccionado.'
        ]);

        Grado::create([
            'nivel_id' => $request->nivel_id,
            'curso' => $request->curso,
            'paralelo' => $request->paralelo,
            'estado' => true,
        ]);

        return redirect()->route('grados.index')->with('success', 'Grado registrado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $grado = Grado::findOrFail($id);

        $request->validate([
            'nivel_id' => 'required|exists:niveles,id_nivel',
            'curso' => [
                'required',
                'string',
                'max:100',
                // Único ignorando el registro actual que estamos editando
                Rule::unique('grados')->where(function ($query) use ($request) {
                    return $query->where('nivel_id', $request->nivel_id)
                        ->where('paralelo', $request->paralelo);
                })->ignore($id, 'id_grado'),
            ],
            'paralelo' => 'required|string|max:50',
        ], [
            'curso.unique' => 'Ya existe otro curso con este mismo paralelo registrado para el nivel seleccionado.'
        ]);

        $grado->update([
            'nivel_id' => $request->nivel_id,
            'curso' => $request->curso,
            'paralelo' => $request->paralelo,
        ]);

        return redirect()->route('grados.index')->with('success', 'Grado actualizado correctamente.');
    }

    public function destroy($id)
    {
        $grado = Grado::findOrFail($id);
        $grado->delete();

        return redirect()->route('grados.index')->with('success', 'Grado eliminado correctamente.');
    }
}
