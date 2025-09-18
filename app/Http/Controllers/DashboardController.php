<?php

namespace App\Http\Controllers;

use App\Models\Confirmando;
use App\Models\Comunidad;
use App\Models\Jornada;
use App\Models\Guia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Contamos todos los registros de cada modelo
        $confirmandos = Confirmando::all();
        $comunidades = Comunidad::all();
        $jornadas = Jornada::withCount('asistencias')->get(); // Contamos las asistencias para saber si la jornada tiene datos

        // Puedes crear otras consultas para obtener datos específicos
        $guias = Guia::all();
        
        return view('dashboard', [
            'confirmandos' => $confirmandos,
            'comunidades' => $comunidades,
            'jornadas' => $jornadas,
            'guias' => $guias,
        ]);
    }

    
}