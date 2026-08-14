<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Docente;
use App\Models\Student;
use App\Models\Materia;
use App\Models\Asignacion;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 1. Obtenemos las asistencias filtradas mediante el scope del modelo
        $asistencias = Asistencia::with(['docente.persona', 'estudiante.persona', 'materia'])
            ->filtrarPorRol($user)
            ->latest()
            ->get();

        // 2. Cargamos los datos para los select de los modales según el rol
        $datos = $this->obtenerDatosParaModales($user);

        return view('asistencias.index', compact('asistencias') + $datos);
    }

    private function obtenerDatosParaModales($user)
    {
        // Si es Administrador (rol_id == 1) ve todo de forma global
        if ($user->rol_id == 1) {
            return [
                'docentes' => Docente::with('persona')->get(),
                'materias' => Materia::all(),
                'estudiantes' => Student::with('persona')->get()
            ];
        }

        // Si es Docente (rol_id == 2) solo ve sus asignaciones reales
        $docente = $user->docente;

        if (!$docente) {
            return [
                'docentes' => [],
                'materias' => collect(),
                'estudiantes' => collect()
            ];
        }

        $asignaciones = Asignacion::where('docente_id', $docente->id_docente)->get();

        return [
            'docentes' => [$docente], // Solo él mismo
            'materias' => Materia::whereIn('id_materia', $asignaciones->pluck('materia_id'))->get(),
            'estudiantes' => Student::whereIn('grado_id', $asignaciones->pluck('grado_id'))->with('persona')->get()
        ];
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Si es un docente, forzamos de manera segura que el docente_id sea el suyo propio
        if ($user->rol_id == 2 && $user->docente) {
            $request->merge(['docente_id' => $user->docente->id_docente]);
        }

        $request->validate([
            'docente_id' => 'required|exists:docentes,id_docente',
            'estudiante_id' => 'required|exists:estudiantes,id_estudiante',
            'materia_id' => 'required|exists:materias,id_materia',
            'fecha' => 'required|string|max:50',
            'observacion' => 'nullable|string|max:255',
            'estado' => 'required|boolean',
        ]);

        Asistencia::create($request->all());

        return redirect()->route('asistencias.index')->with('success', 'Asistencia registrada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $user = auth()->user();

        // Seguridad extra: Si es docente, aseguramos que no modifique registros ajenos
        if ($user->rol_id == 2 && $user->docente) {
            if ($asistencia->docente_id !== $user->docente->id_docente) {
                abort(403, 'No autorizado para modificar este registro.');
            }
            $request->merge(['docente_id' => $user->docente->id_docente]);
        }

        $request->validate([
            'docente_id' => 'required|exists:docentes,id_docente',
            'estudiante_id' => 'required|exists:estudiantes,id_estudiante',
            'materia_id' => 'required|exists:materias,id_materia',
            'fecha' => 'required|string|max:50',
            'observacion' => 'nullable|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $asistencia->update($request->all());

        return redirect()->route('asistencias.index')->with('success', 'Asistencia actualizada correctamente.');
    }

    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $user = auth()->user();

        // Seguridad extra para la eliminación
        if ($user->rol_id == 2 && $user->docente) {
            if ($asistencia->docente_id !== $user->docente->id_docente) {
                abort(403, 'No autorizado para eliminar este registro.');
            }
        }

        $asistencia->delete();

        return redirect()->route('asistencias.index')->with('success', 'Asistencia eliminada correctamente.');
    }
}
