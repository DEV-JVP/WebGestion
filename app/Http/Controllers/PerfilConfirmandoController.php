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

        if ($request->has('dni')) {
            $request->validate([
                'dni' => 'required|string',
            ]);

            $confirmando = Confirmando::with(['asistencias.jornada', 'comunidad.guias'])
                ->where('dni', $request->dni)
                ->first();

            if (!$confirmando) {
                return redirect()->route('welcome')->withErrors(['dni' => 'no actualizado']);
            }
        }

        return view('welcome', compact('confirmando'));
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
