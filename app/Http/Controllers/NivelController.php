<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use App\Models\Gestion;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    public function index()
    {
        $niveles = Nivel::with('gestion')->get();
        $gestiones = Gestion::all();
        return view('niveles.index', compact('niveles', 'gestiones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gestion_id' => 'required|exists:gestiones,id_gestion',
            'nivel' => 'required|string|max:255',
            'turno' => 'required|string|max:50',
        ]);

        Nivel::create([
            'gestion_id' => $request->gestion_id,
            'nivel' => $request->nivel,
            'turno' => $request->turno,
            'estado' => true,
        ]);

        return redirect()->route('niveles.index')->with('success', 'Nivel registrado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $nivel = Nivel::findOrFail($id);

        $request->validate([
            'gestion_id' => 'required|exists:gestiones,id_gestion',
            'nivel' => 'required|string|max:255',
            'turno' => 'required|string|max:50',
        ]);

        $nivel->update([
            'gestion_id' => $request->gestion_id,
            'nivel' => $request->nivel,
            'turno' => $request->turno,
        ]);

        return redirect()->route('niveles.index')->with('success', 'Nivel actualizado correctamente.');
    }

    public function destroy($id)
    {
        $nivel = Nivel::findOrFail($id);
        $nivel->delete();

        return redirect()->route('niveles.index')->with('success', 'Nivel eliminado correctamente.');
    }
}
