<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confirmando;
use App\Models\Documento;
use App\Models\Comunidad;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentoController extends Controller
{
    // Listado de documentos
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

    // Editar un documento específico
public function edit(Confirmando $confirmando)
{
    // Obtiene el primer documento del confirmando o crea uno nuevo
    $documento = $confirmando->documentos()->first() ?? new Documento(['confirmando_id' => $confirmando->id]);

    return view('documentos.edit', compact('confirmando', 'documento'));
}





    // Actualizar un documento específico
    public function update(Request $request, Confirmando $confirmando, Documento $documento)
    {
        $documento->dni_confirmando = $request->has('dni_confirmando');
        $documento->partida_bautizo = $request->has('partida_bautizo');
        $documento->dni_padrino = $request->has('dni_padrino');
        $documento->constancia_confirmacion = $request->has('constancia_confirmacion');
        $documento->partida_matrimonio_religioso = $request->has('partida_matrimonio_religioso');

        $documento->save();

        return redirect()->route('confirmandos.index', [$confirmando->id, $documento->id])
            ->with('success', 'Documento actualizado correctamente.');
    }

    public function editGene(Confirmando $confirmando)
{
    // Obtiene el primer documento del confirmando o crea uno nuevo
    $documento = $confirmando->documentos()->first() ?? new Documento(['confirmando_id' => $confirmando->id]);

    return view('documentos.edit', compact('confirmando', 'documento'));
}

    public function updateGeneral(Request $request, Confirmando $confirmando, Documento $documento)
    {
        $documento->dni_confirmando = $request->has('dni_confirmando');
        $documento->partida_bautizo = $request->has('partida_bautizo');
        $documento->dni_padrino = $request->has('dni_padrino');
        $documento->constancia_confirmacion = $request->has('constancia_confirmacion');
        $documento->partida_matrimonio_religioso = $request->has('partida_matrimonio_religioso');

        $documento->save();

        return redirect()->route('documentos.index', [$confirmando->id, $documento->id])
            ->with('success', 'Documento actualizado correctamente.');
    }


    // Exportar todos los documentos a CSV
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

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');

            // Encabezados (UTF-8 con BOM)
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, $columns);

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
