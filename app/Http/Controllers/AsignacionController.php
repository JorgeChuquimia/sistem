<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Docente;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Materia;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    public function index()
    {
        $asignaciones = Asignacion::with(['docente.persona', 'nivel', 'grado', 'materia'])->get();
        $docentes = Docente::with('persona')->get();
        $niveles = Nivel::all();
        $grados = Grado::all();
        $materias = Materia::all();

        return view('asignaciones.index', compact('asignaciones', 'docentes', 'niveles', 'grados', 'materias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|exists:docentes,id_docente',
            'nivel_id' => 'required|exists:niveles,id_nivel',
            'grado_id' => 'required|exists:grados,id_grado',
            'materia_id' => 'required|exists:materias,id_materia',
        ]);

        Asignacion::create([
            'docente_id' => $request->docente_id,
            'nivel_id' => $request->nivel_id,
            'grado_id' => $request->grado_id,
            'materia_id' => $request->materia_id,
            'estado' => true,
        ]);

        return redirect()->route('asignaciones.index')->with('success', 'Asignación registrada correctamente.');
    }
    public function update(Request $request, $id)
    {
        $asignacion = Asignacion::findOrFail($id);

        $request->validate([
            'docente_id' => 'required|exists:docentes,id_docente',
            'nivel_id' => 'required|exists:niveles,id_nivel',
            'grado_id' => 'required|exists:grados,id_grado',
            'materia_id' => 'required|exists:materias,id_materia',
        ]);

        $asignacion->update([
            'docente_id' => $request->docente_id,
            'nivel_id' => $request->nivel_id,
            'grado_id' => $request->grado_id,
            'materia_id' => $request->materia_id,
        ]);

        return redirect()->route('asignaciones.index')->with('success', 'Asignación actualizada correctamente.');
    }
    public function destroy($id)
    {
        $asignacion = Asignacion::findOrFail($id);
        $asignacion->delete();

        return redirect()->route('asignaciones.index')->with('success', 'Asignación eliminada correctamente.');
    }
}
