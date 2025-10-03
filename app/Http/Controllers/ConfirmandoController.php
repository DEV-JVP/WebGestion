<?php

namespace App\Http\Controllers;

use App\Models\Confirmando;
use Illuminate\Http\Request;
use App\Models\Comunidad;
use App\Models\Documento;

use App\Models\Sacramento;

class ConfirmandoController extends Controller
{
    public function index()
    {
        $confirmandos = Confirmando::paginate(10);
        return view('confirmandos.index', compact('confirmandos'));
    }


    public function create()
    {

        $comunidades = Comunidad::all();
        $sacramentos = Sacramento::all();
        return view('confirmandos.create', compact('comunidades', 'sacramentos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dni' => 'required|unique:confirmandos',
            'nombre' => 'required',
            'colegio' => 'nullable',
            'capilla_cercana' => 'nullable',
            'direccion' => 'nullable',
            'contacto_emergencia' => 'nullable',
            'observaciones' => 'nullable',
            'nombre_padre' => 'nullable',
            'telefono_padre' => 'nullable',
            'nombre_madre' => 'nullable',
            'telefono_madre' => 'nullable',
            'comunidad_id' => 'nullable|exists:comunidades,id',
            'sacramentos' => 'array',
            'sacramentos.*' => 'exists:sacramentos,id',
              'situacion_matrimonial_padres' => 'nullable|in:casados,convivientes,separados,divorciados,viudos,otros',
            'situacion_matrimonial_comentario' => 'nullable|string|max:255',
            'tipo_sangre' => 'nullable|string|max:5',
            'alergias' => 'nullable|string',
        ]);

        $confirmando = Confirmando::create($validated);

        if ($request->has('sacramentos')) {
            $confirmando->sacramentos()->sync($request->sacramentos);
        }

        return redirect()->route('confirmandos.index')
            ->with('success', 'Confirmando registrado correctamente');
    }


    public function show(Confirmando $confirmando)
    {
        return view('confirmandos.show', compact('confirmando'));
    }


    public function edit(Confirmando $confirmando)
    {
        $sacramentos = Sacramento::all();
        $comunidades = Comunidad::all(); // Para mostrar todas las opciones en el select
        return view('confirmandos.edit', compact('confirmando', 'comunidades', 'sacramentos'));
    }

    public function update(Request $request, Confirmando $confirmando)
    {
        $data = $request->validate([
            'dni' => 'required|unique:confirmandos,dni,' . $confirmando->id,
            'nombre' => 'required',
            'colegio' => 'nullable',
            'capilla_cercana' => 'nullable',
            'direccion' => 'nullable',
            'contacto_emergencia' => 'nullable',
            'observaciones' => 'nullable',
            'nombre_padre' => 'nullable',
            'telefono_padre' => 'nullable',
            'nombre_madre' => 'nullable',
            'telefono_madre' => 'nullable',
            'comunidad_id' => 'nullable|exists:comunidades,id',
            'sacramentos' => 'array',
            'sacramentos.*' => 'exists:sacramentos,id',

             'situacion_matrimonial_padres' => 'nullable|in:casados,convivientes,separados,divorciados,viudos,otros',
            'situacion_matrimonial_comentario' => 'nullable|string|max:255',
            'tipo_sangre' => 'nullable|string|max:5',
            'alergias' => 'nullable|string',
        ]);

        // Actualizar los datos principales
        $confirmando->update($data);

        // Sincronizar sacramentos seleccionados
        if ($request->has('sacramentos')) {
            $confirmando->sacramentos()->sync($request->sacramentos);
        } else {
            $confirmando->sacramentos()->sync([]); // limpia si no seleccionaron ninguno
        }

        return redirect()->route('confirmandos.index')
            ->with('success', 'Confirmando actualizado correctamente.');
    }


    public function destroy(Confirmando $confirmando)
    {
        $confirmando->delete();
        return redirect()->route('confirmandos.index')->with('success', 'Confirmando eliminado.');
    }
}
