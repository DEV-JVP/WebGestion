<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Confirmando;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index(Confirmando $confirmando)
    {
        $pagos = $confirmando->pagos()->latest()->paginate(10);
        return view('pagos.index', compact('confirmando', 'pagos'));
    }

    public function create(Confirmando $confirmando)
    {
        return view('pagos.create', compact('confirmando'));
    }

    public function store(Request $request, Confirmando $confirmando)
    {
        $validated = $request->validate([
            'monto' => 'required|numeric',
            'fecha' => 'required|date',
            'boleta' => 'nullable|string',
            'tipo' => 'required|in:inscripcion,mensualidad,extraordinario',
            'observacion' => 'nullable|string',
        ]);

        $validated['confirmando_id'] = $confirmando->id;

        Pago::create($validated);

        return redirect()->route('pagos.index', $confirmando)->with('success', 'Pago registrado correctamente.');
    }

    public function edit(Confirmando $confirmando, Pago $pago)
    {
        return view('pagos.edit', compact('confirmando', 'pago'));
    }

    public function update(Request $request, Confirmando $confirmando, Pago $pago)
    {
        $validated = $request->validate([
            'monto' => 'required|numeric',
            'fecha' => 'required|date',
            'boleta' => 'nullable|string',
            'tipo' => 'required|in:inscripcion,mensualidad,extraordinario',
            'observacion' => 'nullable|string',
        ]);

        $pago->update($validated);

        return redirect()->route('pagos.index', $confirmando)->with('success', 'Pago actualizado correctamente.');
    }

    public function destroy(Confirmando $confirmando, Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index', $confirmando)->with('success', 'Pago eliminado.');
    }

    public function show(Confirmando $confirmando, Pago $pago)
    {
        return view('pagos.show', compact('confirmando', 'pago'));
    }
}
