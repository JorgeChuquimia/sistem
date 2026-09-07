<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Docente;
use App\Models\Nivel;
use App\Models\Grado;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'grado_id' => [
                'required',
                'exists:grados,id_grado',
                // Validación para asegurar que el grado pertenezca al nivel seleccionado
                function ($attribute, $value, $fail) use ($request) {
                    $grado = Grado::find($value);
                    if ($grado && $grado->nivel_id != $request->nivel_id) {
                        $fail('El grado seleccionado no pertenece al nivel indicado.');
                    }
                },
                // Regla compuesta única alineada con el índice de la BD
                Rule::unique('asignaciones')->where(function ($query) use ($request) {
                    return $query->where('docente_id', $request->docente_id)
                        ->where('nivel_id', $request->nivel_id)
                        ->where('materia_id', $request->materia_id);
                }),
            ],
            'materia_id' => 'required|exists:materias,id_materia',
        ], [
            'grado_id.unique' => 'Este docente ya tiene asignada esta misma materia en este nivel y grado.',
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
            'grado_id' => [
                'required',
                'exists:grados,id_grado',
                function ($attribute, $value, $fail) use ($request) {
                    $grado = Grado::find($value);
                    if ($grado && $grado->nivel_id != $request->nivel_id) {
                        $fail('El grado seleccionado no pertenece al nivel indicado.');
                    }
                },
                // Validación única ignorando el registro actual
                Rule::unique('asignaciones')->where(function ($query) use ($request) {
                    return $query->where('docente_id', $request->docente_id)
                        ->where('nivel_id', $request->nivel_id)
                        ->where('materia_id', $request->materia_id);
                })->ignore($id, 'id_asignacion'),
            ],
            'materia_id' => 'required|exists:materias,id_materia',
        ], [
            'grado_id.unique' => 'Ya existe otra asignación idéntica para este docente, nivel, grado y materia.',
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
