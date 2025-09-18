<?php

namespace App\Http\Controllers;

use App\Models\Guia;
use App\Models\Comunidad;
use Illuminate\Http\Request;

class GuiaController extends Controller
{
    public function index()
    {
        $guias = Guia::with('comunidad')->paginate(10);
        return view('guias.index', compact('guias'));
    }

    public function create()
    {
        $comunidades = Comunidad::all();
        return view('guias.create', compact('comunidades'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:50',         
            'comunidad_id' => 'required|exists:comunidades,id',
        ]);

        Guia::create($validated);

        return redirect()->route('guias.index')->with('success', 'Guía creada correctamente.');
    }

    public function show(Guia $guia)
    {
        return view('guias.show', compact('guia'));
    }

    public function edit(Guia $guia)
    {
        $comunidades = Comunidad::all();
        return view('guias.edit', compact('guia', 'comunidades'));
    }

    public function update(Request $request, Guia $guia)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:50',      
            'comunidad_id' => 'required|exists:comunidades,id',
        ]);

        $guia->update($validated);

        return redirect()->route('guias.index')->with('success', 'Guía actualizada correctamente.');
    }

    public function destroy(Guia $guia)
    {
        $guia->delete();
        return redirect()->route('guias.index')->with('success', 'Guía eliminada.');
    }
}
