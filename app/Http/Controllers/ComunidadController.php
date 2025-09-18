<?php

namespace App\Http\Controllers;

use App\Models\Comunidad;
use App\Models\Confirmando;
use Illuminate\Http\Request;

class ComunidadController extends Controller
{
    public function index()
    {
        $comunidades = Comunidad::with('confirmandos','guias')->paginate(10);
        return view('comunidades.index', compact('comunidades'));
    }

    public function create()
    {
        return view('comunidades.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'comentario_coordinacion' => 'nullable|string',
        ]);

        Comunidad::create($validated);

        return redirect()->route('comunidades.index')->with('success', 'Comunidad creada correctamente.');
    }

   public function show(Comunidad $comunidad)
{
    $comunidad->load('guias', 'confirmandos'); // 🔑 Esto es clave
    return view('comunidades.show', compact('comunidad'));
}

    public function edit(Comunidad $comunidad)
    {
        return view('comunidades.edit', compact('comunidad'));
    }

    public function update(Request $request, Comunidad $comunidad)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'comentario_coordinacion' => 'nullable|string',
        ]);

        $comunidad->update($validated);

        return redirect()->route('comunidades.index')->with('success', 'Comunidad actualizada correctamente.');
    }

    public function destroy(Comunidad $comunidad)
    {
        $comunidad->delete();
        return redirect()->route('comunidades.index')->with('success', 'Comunidad eliminada.');
    }

    // Reporte de asistencia opcional
    public function reporte(Comunidad $comunidad)
    {
        $comunidad->load('confirmandos.asistencias.jornada');
        return view('comunidades.reporte', compact('comunidad'));
    }

    public function designar()
    {
        // Trae todos los confirmandos con su comunidad actual
        $confirmandos = Confirmando::with('comunidad')->get();

        // Trae todas las comunidades
        $comunidades = Comunidad::all();

        return view('comunidades.designar', compact('confirmandos', 'comunidades'));
    }

    /**
     * Guardar asignaciones de confirmandos a comunidades.
     */
   public function guardarDesignacion(Request $request)
{
    foreach ($request->confirmandos as $confirmandoId => $comunidadId) {
        Confirmando::where('id', $confirmandoId)
            ->update(['comunidad_id' => $comunidadId]);
    }

    return redirect()->route('comunidades.index')
        ->with('success', 'Confirmandos asignados correctamente.');
}

}
