<?php

namespace App\Http\Controllers;
use App\Models\Jornada;
use App\Models\Confirmando;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function edit(Jornada $jornada)
{
    $confirmandos = Confirmando::all();
    $asistencias = $jornada->asistencias->keyBy('confirmando_id');
    return view('asistencias.edit', compact('jornada','confirmandos','asistencias'));
}

public function update(Request $request, Jornada $jornada)
{
    foreach($request->asistencias as $confirmando_id => $estado){
        Asistencia::updateOrCreate(
            ['confirmando_id' => $confirmando_id, 'jornada_id' => $jornada->id],
            ['estado' => $estado]
        );
    }

    return redirect()->route('jornadas.index')->with('success','Asistencias registradas.');
}

}
