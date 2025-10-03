<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confirmando;

class PerfilConfirmandoController extends Controller
{
    // Formulario para ingresar DNI
    public function showForm()
    {
        return view('perfil.form');
    }

    // Buscar confirmando por DNI
    public function search(Request $request)
    {
        $request->validate([
            'dni' => 'required|string'
        ]);

        $confirmando = Confirmando::with(['asistencias.jornada', 'comunidad.guias'])
            ->where('dni', $request->dni)
            ->first();

        if (!$confirmando) {
            return back()->withErrors(['dni' => 'No se encontró un confirmando con ese DNI']);
        }

        return view('perfil.show', compact('confirmando'));
    }
public function welcome(Request $request)
{
    $confirmando = null;
    // Documento por defecto si no hay registro
    $documentos = new \App\Models\Documento([
        'dni_confirmando' => false,
        'partida_bautizo' => false,
        'dni_padrino' => false,
        'constancia_confirmacion' => false,
        'partida_matrimonio_religioso' => false,
    ]);

    if ($request->has('dni')) {
        $request->validate([
            'dni' => 'required|string',
        ]);

        $confirmando = Confirmando::with(['asistencias.jornada', 'comunidad.guias', 'documentos'])
            ->where('dni', $request->dni)
            ->first();

        if (!$confirmando) {
            return redirect()->route('welcome')->withErrors(['dni' => 'no actualizado']);
        }

        // Si hay documentos asociados, toma el primero
        if ($confirmando->documentos && $confirmando->documentos->count() > 0) {
            $documentos = $confirmando->documentos->first();
        }
    }

    return view('welcome', compact('confirmando', 'documentos'));
}


    public function buscar(Request $request)
    {
        $request->validate([
            'dni' => 'required|string',
        ]);

        $confirmando = Confirmando::with(['asistencias.jornada', 'comunidad'])
            ->where('dni', $request->dni)
            ->first();

        if (!$confirmando) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró un confirmando con ese DNI',
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $confirmando,
        ]);
    }
}
