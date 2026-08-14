<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        return view('materias.index', compact('materias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_materia' => 'required|string|max:100|unique:materias,nombre_materia',
        ]);

        Materia::create([
            'nombre_materia' => $request->nombre_materia,
            'estado' => true,
        ]);

        return redirect()->route('materias.index')->with('success', 'Materia registrada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);

        $request->validate([
            'nombre_materia' => 'required|string|max:100|unique:materias,nombre_materia,' . $id . ',id_materia',
        ]);

        $materia->update([
            'nombre_materia' => $request->nombre_materia,
        ]);

        return redirect()->route('materias.index')->with('success', 'Materia actualizada correctamente.');
    }

    public function destroy($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();

        return redirect()->route('materias.index')->with('success', 'Materia eliminada correctamente.');
    }
}
