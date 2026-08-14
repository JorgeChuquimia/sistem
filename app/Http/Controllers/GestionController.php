<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    public function index()
    {
        $gestiones = Gestion::all();
        return view('gestiones.index', compact('gestiones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gestion' => 'required|string|max:50|unique:gestiones,gestion',
        ]);

        Gestion::create([
            'gestion' => $request->gestion,
            'estado' => true,
        ]);

        return redirect()->route('gestiones.index')->with('success', 'Gestión registrada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $gestion = Gestion::findOrFail($id);

        $request->validate([
            'gestion' => 'required|string|max:50|unique:gestiones,gestion,' . $id . ',id_gestion',
        ]);

        $gestion->update([
            'gestion' => $request->gestion,
        ]);

        return redirect()->route('gestiones.index')->with('success', 'Gestión actualizada correctamente.');
    }

    public function destroy($id)
    {
        $gestion = Gestion::findOrFail($id);
        $gestion->delete();

        return redirect()->route('gestiones.index')->with('success', 'Gestión eliminada correctamente.');
    }
}
