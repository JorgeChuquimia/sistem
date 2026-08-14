<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Persona;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::with('persona')->get();
        $personas = Persona::all(); // Para asignarle los datos personales al crear el docente
        return view('docentes.index', compact('docentes', 'personas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id_persona|unique:docentes,persona_id',
            'especialidad' => 'required|string|max:255',
            'antiguedad' => 'required|string|max:50',
            'rda' => 'required|string|max:20|unique:docentes,rda',
        ]);

        Docente::create([
            'persona_id' => $request->persona_id,
            'especialidad' => $request->especialidad,
            'antiguedad' => $request->antiguedad,
            'rda' => $request->rda,
            'estado' => true,
        ]);

        return redirect()->route('docentes.index')->with('success', 'Docente registrado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $docente = Docente::findOrFail($id);

        $request->validate([
            'persona_id' => 'required|exists:personas,id_persona|unique:docentes,persona_id,' . $id . ',id_docente',
            'especialidad' => 'required|string|max:255',
            'antiguedad' => 'required|string|max:50',
            'rda' => 'required|string|max:20|unique:docentes,rda,' . $id . ',id_docente',
        ]);

        $docente->update([
            'persona_id' => $request->persona_id,
            'especialidad' => $request->especialidad,
            'antiguedad' => $request->antiguedad,
            'rda' => $request->rda,
        ]);

        return redirect()->route('docentes.index')->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy($id)
    {
        $docente = Docente::findOrFail($id);
        $docente->delete();

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado correctamente.');
    }
}
