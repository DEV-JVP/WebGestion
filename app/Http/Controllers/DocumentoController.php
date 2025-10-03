<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confirmando;
use App\Models\Documento;
use App\Models\Comunidad;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentoController extends Controller
{

public function index(Request $request)
{
    $search = $request->input('search');
    $perPage = $request->input('per_page', 5);
    $comunidadId = $request->input('comunidad_id');

    $documentos = Documento::with('confirmando.comunidad')
        ->when($search, function ($query, $search) {
            $query->whereHas('confirmando', fn($q) => $q->where('nombre', 'like', "%$search%"));
        })
        ->when($comunidadId, function ($query, $comunidadId) {
            $query->whereHas('confirmando', fn($q) => $q->where('comunidad_id', $comunidadId));
        })
        ->paginate($perPage)
        ->withQueryString();

    $comunidades = Comunidad::all();

    return view('documentos.index', compact('documentos', 'search', 'perPage', 'comunidades', 'comunidadId'));
}


    public function edit(Confirmando $confirmando)
    {
        $documentos = $confirmando->documentos;
        return view('documentos.edit', compact('confirmando', 'documentos'));
    }

    public function update(Request $request, Confirmando $confirmando)
    {
        $documentos = $confirmando->documentos ?? new Documento();
        $documentos->confirmando_id = $confirmando->id;

        $documentos->dni_confirmando = $request->has('dni_confirmando');
        $documentos->partida_bautizo = $request->has('partida_bautizo');
        $documentos->dni_padrino = $request->has('dni_padrino');
        $documentos->constancia_confirmacion = $request->has('constancia_confirmacion');
        $documentos->partida_matrimonio_religioso = $request->has('partida_matrimonio_religioso');

        $documentos->save();

        return redirect()->route('documentos.index', $confirmando)
                         ->with('success', 'Documentos actualizados correctamente.');
    }

    public function export(): StreamedResponse
    {
        $fileName = 'documentos_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'Confirmando',
            'DNI Confirmando',
            'Partida Bautizo',
            'DNI Padrino',
            'Constancia Confirmación',
            'Partida Matrimonio Religioso'
        ];

        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');

            // Encabezados (UTF-8 con BOM para que Excel reconozca bien tildes/ñ)
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, $columns);

            // Filas
            Documento::with('confirmando')->chunk(100, function ($documentos) use ($file) {
                foreach ($documentos as $doc) {
                    fputcsv($file, [
                        $doc->confirmando->nombre,
                        $doc->dni_confirmando ? 'Sí' : 'No',
                        $doc->partida_bautizo ? 'Sí' : 'No',
                        $doc->dni_padrino ? 'Sí' : 'No',
                        $doc->constancia_confirmacion ? 'Sí' : 'No',
                        $doc->partida_matrimonio_religioso ? 'Sí' : 'No',
                    ]);
                }
            });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

