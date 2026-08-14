<?php

namespace App\Http\Controllers;

use App\Models\Grado;
use App\Models\Nivel;
use Illuminate\Http\Request;

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
            'curso' => 'required|string|max:100',
            'paralelo' => 'required|string|max:50',
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
            'curso' => 'required|string|max:100',
            'paralelo' => 'required|string|max:50',
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
