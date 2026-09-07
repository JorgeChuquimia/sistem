<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Student;
use App\Models\Docente;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asistencias = Asistencia::with(['estudiante.persona', 'docente.persona', 'materia'])
            ->filtrarPorRol(Auth::user())
            ->get();

        $estudiantes = Student::with('persona')->get();
        $docentes = Docente::with('persona')->get();
        $materias = Materia::all();

        return view('asistencias.index', compact('asistencias', 'estudiantes', 'docentes', 'materias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Si el usuario autenticado es un docente, forzamos su ID por seguridad
        if (Auth::user()->docente) {
            $request->merge([
                'docente_id' => Auth::user()->docente->id_docente
            ]);
        }

        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id_estudiante',
            'docente_id'    => 'required|exists:docentes,id_docente',
            'materia_id'    => 'required|exists:materias,id_materia',
            'fecha'         => [
                'required',
                'date',
                Rule::unique('asistencias')->where(function ($query) use ($request) {
                    return $query->where('estudiante_id', $request->estudiante_id)
                        ->where('materia_id', $request->materia_id)
                        ->where('fecha', $request->fecha);
                }),
            ],
            // Validamos que sea booleano (1 o 0) ya que la base de datos es tinyint
            'estado'        => 'required|boolean',
            'observacion'   => 'nullable|string|max:255',
        ], [
            'fecha.unique' => 'Este estudiante ya tiene registrada una asistencia para esta materia en la misma fecha.',
        ]);

        Asistencia::create([
            'docente_id'    => $request->docente_id,
            'estudiante_id' => $request->estudiante_id,
            'materia_id'    => $request->materia_id,
            'fecha'         => $request->fecha,
            'estado'        => $request->estado,
            'observacion'   => $request->observacion,
        ]);

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia registrada correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $asistencia = Asistencia::findOrFail($id);

        // Si es un docente, mantenemos o forzamos su propio ID
        if (Auth::user()->docente) {
            $request->merge([
                'docente_id' => Auth::user()->docente->id_docente
            ]);
        }

        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id_estudiante',
            'docente_id'    => 'required|exists:docentes,id_docente',
            'materia_id'    => 'required|exists:materias,id_materia',
            'fecha'         => [
                'required',
                'date',
                Rule::unique('asistencias')->where(function ($query) use ($request) {
                    return $query->where('estudiante_id', $request->estudiante_id)
                        ->where('materia_id', $request->materia_id)
                        ->where('fecha', $request->fecha);
                })->ignore($asistencia->id_asistencia, 'id_asistencia'),
            ],
            // Validamos que sea booleano (1 o 0)
            'estado'        => 'required|boolean',
            'observacion'   => 'nullable|string|max:255',
        ], [
            'fecha.unique' => 'Ya existe otro registro de asistencia para este estudiante en la misma fecha y materia.',
        ]);

        $asistencia->update([
            'docente_id'    => $request->docente_id,
            'estudiante_id' => $request->estudiante_id,
            'materia_id'    => $request->materia_id,
            'fecha'         => $request->fecha,
            'estado'        => $request->estado,
            'observacion'   => $request->observacion,
        ]);

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->delete();

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia eliminada correctamente.');
    }
}
