<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
      <div class="max-w-4xl mx-auto mt-6 p-6 bg-[#161b22] rounded-lg shadow-xl border border-gray-700">

        <h1 class="text-3xl font-bold text-gray-100 mb-6 border-b border-gray-700 pb-4 flex items-center">
            <svg class="w-8 h-8 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            {{ $confirmando->nombre }}
        </h1>

        {{-- Información personal --}}
        <h2 class="text-xl font-semibold mt-4 text-red-400">Información personal</h2>
        <div class="text-gray-300 space-y-1 mt-2">
            <p><strong>DNI:</strong> {{ $confirmando->dni }}</p>
            <p><strong>Colegio:</strong> {{ $confirmando->colegio ?? 'N/A' }}</p>
            <p><strong>Capilla cercana:</strong> {{ $confirmando->capilla_cercana ?? 'N/A' }}</p>
            <p><strong>Dirección:</strong> {{ $confirmando->direccion ?? 'N/A' }}</p>
            <p><strong>Observaciones:</strong> {{ $confirmando->observaciones ?? 'N/A' }}</p>
            <p><strong>Comunidad:</strong> {{ $confirmando->comunidad?->nombre ?? 'Sin comunidad asignada' }}</p>
        </div>

        {{-- Asistencias --}}
        <h2 class="text-xl font-semibold mt-8 text-red-400">Asistencias</h2>
        <div class="overflow-x-auto rounded-lg shadow-lg mt-2">
            <table class="w-full text-left text-gray-300">
                <thead class="bg-[#21262d] text-gray-400 border-b border-gray-700">
                    <tr>
                        <th class="p-4">Fecha</th>
                        <th class="p-4">Tema</th>
                        <th class="p-4">Estado</th>
                    </tr>
                </thead>
                <tbody class="bg-[#161b22] divide-y divide-gray-700">
                    @forelse($confirmando->asistencias as $asistencia)
                    <tr class="hover:bg-gray-800 transition-colors duration-150">
                        <td class="p-4">{{ \Carbon\Carbon::parse($asistencia->jornada->fecha)->format('d/m/Y') }}</td>
                        <td class="p-4">{{ $asistencia->jornada->tema }}</td>
                        <td class="p-4">
                            @switch($asistencia->estado)
                            @case('asistio')
                            <span class="bg-red-500 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">Asistió</span>
                            @break
                            @case('tardanza')
                            <span class="bg-yellow-500 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">Tardanza</span>
                            @break
                            @case('falta_justificada')
                            <span class="bg-red-500 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">Falta Justificada</span>
                            @break
                            @case('falta_sin_justificar')
                            <span class="bg-red-500 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">Falta Sin Justificar</span>
                            @break
                            @default
                            <span class="bg-gray-500 text-white text-xs font-medium px-2.5 py-0.5 rounded-full">Sin registro</span>
                            @endswitch
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">No hay registros de asistencia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-6 border-t border-gray-700">
            <a href="{{ route('perfil.form') }}" class="flex items-center w-fit px-4 py-2 bg-gray-600 text-white rounded-lg shadow-md hover:bg-gray-700 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver
            </a>
        </div>
    </div>
</body>
</html>
  
