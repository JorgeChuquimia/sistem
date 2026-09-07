<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use App\Models\Gestion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'nivel' => [
                'required',
                'string',
                'max:255',
                // Validamos que la combinación de gestion, nivel y turno sea única
                Rule::unique('niveles')->where(function ($query) use ($request) {
                    return $query->where('gestion_id', $request->gestion_id)
                        ->where('turno', $request->turno);
                }),
            ],
            'turno' => 'required|string|max:50',
        ], [
            'nivel.unique' => 'Ya existe un nivel con este mismo turno registrado para la gestión seleccionada.'
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
            'nivel' => [
                'required',
                'string',
                'max:255',
                // Único ignorando el registro actual que estamos editando (usando su clave primaria id_nivel)
                Rule::unique('niveles')->where(function ($query) use ($request) {
                    return $query->where('gestion_id', $request->gestion_id)
                        ->where('turno', $request->turno);
                })->ignore($id, 'id_nivel'),
            ],
            'turno' => 'required|string|max:50',
        ], [
            'nivel.unique' => 'Ya existe otro nivel con este mismo turno registrado para la gestión seleccionada.'
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
