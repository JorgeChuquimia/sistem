<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Persona;
use App\Models\Nivel;
use App\Models\Grado;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Student::with(['persona', 'grado.nivel.gestion'])->get();
        $personas = Persona::all();
        $niveles = Nivel::all();
        $grados = Grado::all();

        return view('estudiantes.index', compact('estudiantes', 'personas', 'niveles', 'grados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id_persona|unique:estudiantes,persona_id',
            'nivel_id' => 'required|exists:niveles,id_nivel',
            'grado_id' => 'required|exists:grados,id_grado',
            'rude' => 'required|string|max:50|unique:estudiantes,rude',
        ]);

        Student::create([
            'persona_id' => $request->persona_id,
            'nivel_id' => $request->nivel_id,
            'grado_id' => $request->grado_id,
            'rude' => $request->rude,
            'estado' => true,
        ]);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante registrado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $estudiante = Student::findOrFail($id);

        $request->validate([
            'persona_id' => 'required|exists:personas,id_persona|unique:estudiantes,persona_id,' . $id . ',id_estudiante',
            'nivel_id' => 'required|exists:niveles,id_nivel',
            'grado_id' => 'required|exists:grados,id_grado',
            'rude' => 'required|string|max:50|unique:estudiantes,rude,' . $id . ',id_estudiante',
        ]);

        $estudiante->update([
            'persona_id' => $request->persona_id,
            'nivel_id' => $request->nivel_id,
            'grado_id' => $request->grado_id,
            'rude' => $request->rude,
        ]);

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    public function destroy($id)
    {
        $estudiante = Student::findOrFail($id);
        $estudiante->delete();

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado correctamente.');
    }
}
