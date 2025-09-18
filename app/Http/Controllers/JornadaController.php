<?php

namespace App\Http\Controllers;
use App\Models\Jornada;
use Illuminate\Http\Request;

class JornadaController extends Controller
{
    public function index()
{
    $jornadas = Jornada::latest()->paginate(10);
    return view('jornadas.index', compact('jornadas'));
}

public function create()
{
    return view('jornadas.create');
}

public function store(Request $request)
{
    $request->validate([
        'fecha' => 'required|date',
        'tema' => 'required|string',
    ]);

    Jornada::create($request->all());
    return redirect()->route('jornadas.index')->with('success','Jornada creada.');
}

public function edit(Jornada $jornada)
{
    return view('jornadas.edit', compact('jornada'));
}

public function update(Request $request, Jornada $jornada)
{
    $request->validate([
        'fecha' => 'required|date',
        'tema' => 'required|string',
    ]);

    $jornada->update($request->all());
    return redirect()->route('jornadas.index')->with('success','Jornada actualizada.');
}

public function destroy(Jornada $jornada)
{
    $jornada->delete();
    return redirect()->route('jornadas.index')->with('success','Jornada eliminada.');
}
}