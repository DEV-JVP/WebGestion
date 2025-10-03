<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta Confirmación</title>
  <script src="https://cdn.tailwindcss.com"></script>

   <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    main {
      flex: 1;
    }
  </style>
</head>
<body class="bg-gradient-to-r from-purple-700 to-blue-500 min-h-screen font-sans">

  <!-- NAV -->
  <nav class="mt-10 flex justify-center">
    <ul class="flex items-center space-x-6 bg-white/20 backdrop-blur-md px-6 py-3 rounded-lg shadow-md">
      <li><a href="#" class="text-white font-semibold hover:text-yellow-300 transition">Inicio</a></li>
      <li><a href="#" class="text-white font-semibold hover:text-yellow-300 transition">Perfil</a></li>
      <li><a href="#" class="text-white font-semibold hover:text-yellow-300 transition">Pagos</a></li>
      <li><a href="#" class="text-white font-semibold hover:text-yellow-300 transition">Documentos</a></li>
      
      <!-- Botón Login -->
      <li>
        <a href="/login" class="bg-yellow-400 text-gray-900 font-bold px-4 py-2 rounded-lg hover:bg-yellow-500 transition">
          Login
        </a>
      </li>
    </ul>
  </nav>

  <!-- BUSCAR -->
  <section id="buscar" class="py-10">
    <div class="max-w-3xl mx-auto">

      <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Consulta (Confirmación)</h2>
        <form method="GET" action="{{ route('welcome') }}" class="flex space-x-2">
          <input type="text" name="dni" class="w-full border-gray-300 rounded-lg focus:ring focus:ring-indigo-200" placeholder="Ingrese DNI" required>
          <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Buscar</button>
        </form>
        @if($errors->any())
          <div class="mt-3 p-3 bg-red-100 text-red-700 rounded">
            {{ $errors->first('dni') }}
          </div>
        @endif
      </div>

      <!-- RESULTADO -->
      @if($confirmando)
      <div class="mt-8 bg-white shadow-lg rounded-lg p-6">
        
        <!-- Datos personales -->
        <h3 class="text-xl font-bold text-indigo-700 mb-4"><i class="bi bi-person-circle mr-2"></i>{{ $confirmando->nombre }}</h3>
        <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
          <p><strong>DNI:</strong> {{ $confirmando->dni }}</p>
          <p><strong>Colegio:</strong> {{ $confirmando->colegio ?? 'N/A' }}</p>
          <p><strong>Capilla cercana:</strong> {{ $confirmando->capilla_cercana ?? 'N/A' }}</p>
          <p><strong>Dirección:</strong> {{ $confirmando->direccion ?? 'N/A' }}</p>
          <p><strong>Observaciones:</strong> {{ $confirmando->observaciones ?? 'N/A' }}</p>
          <p><strong>Comunidad:</strong> {{ $confirmando->comunidad?->nombre ?? 'Sin comunidad asignada' }}</p>
        </div>

        <!-- Asistencias -->
        <h4 class="mt-6 mb-2 text-lg font-semibold text-indigo-700">Asistencias</h4>
        <div class="overflow-x-auto">
          <table class="w-full border border-gray-200 rounded-lg text-sm">
            <thead class="bg-gray-100 text-gray-700">
              <tr>
                <th class="px-3 py-2 border">Fecha</th>
                <th class="px-3 py-2 border">Tema</th>
                <th class="px-3 py-2 border">Estado</th>
              </tr>
            </thead>
            <tbody>
              @forelse($confirmando->asistencias as $asistencia)
              <tr class="text-center">
                <td class="px-3 py-2 border">{{ \Carbon\Carbon::parse($asistencia->jornada->fecha)->format('d/m/Y') }}</td>
                <td class="px-3 py-2 border">{{ $asistencia->jornada->tema }}</td>
                <td class="px-3 py-2 border">
                  @switch($asistencia->estado)
                    @case('asistio')
                      <span class="px-2 py-1 bg-green-200 text-green-700 rounded">Asistió</span>
                      @break
                    @case('tardanza')
                      <span class="px-2 py-1 bg-yellow-200 text-yellow-800 rounded">Tardanza</span>
                      @break
                    @case('falta_justificada')
                      <span class="px-2 py-1 bg-blue-200 text-blue-700 rounded">Falta Justificada</span>
                      @break
                    @case('falta_sin_justificar')
                      <span class="px-2 py-1 bg-red-200 text-red-700 rounded">Falta Sin Justificar</span>
                      @break
                    @default
                      <span class="px-2 py-1 bg-gray-200 text-gray-700 rounded">Sin registro</span>
                  @endswitch
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="px-3 py-2 text-gray-500">No hay registros de asistencia.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <!-- Documentos -->
        <h4 class="mt-6 mb-2 text-lg font-semibold text-indigo-700">Documentos</h4>
        <ul class="grid grid-cols-2 gap-3 text-sm text-gray-700">
          <li class="flex items-center">
            @if($documentos->dni_confirmando) 
              <i class="bi bi-check-circle-fill text-green-600 mr-2"></i>
            @else 
              <i class="bi bi-x-circle-fill text-red-600 mr-2"></i>
            @endif
            DNI Confirmando
          </li>
          <li class="flex items-center">
            @if($documentos->partida_bautizo) 
              <i class="bi bi-check-circle-fill text-green-600 mr-2"></i>
            @else 
              <i class="bi bi-x-circle-fill text-red-600 mr-2"></i>
            @endif
            Partida Bautizo
          </li>
          <li class="flex items-center">
            @if($documentos->dni_padrino) 
              <i class="bi bi-check-circle-fill text-green-600 mr-2"></i>
            @else 
              <i class="bi bi-x-circle-fill text-red-600 mr-2"></i>
            @endif
            DNI Padrino
          </li>
          <li class="flex items-center">
            @if($documentos->constancia_confirmacion) 
              <i class="bi bi-check-circle-fill text-green-600 mr-2"></i>
            @else 
              <i class="bi bi-x-circle-fill text-red-600 mr-2"></i>
            @endif
            Constancia Confirmación
          </li>
          <li class="flex items-center">
            @if($documentos->partida_matrimonio_religioso) 
              <i class="bi bi-check-circle-fill text-green-600 mr-2"></i>
            @else 
              <i class="bi bi-x-circle-fill text-red-600 mr-2"></i>
            @endif
            Partida Matrimonio Religioso
          </li>
        </ul>

      </div>
      @endif

    </div>
  </section>

  <!-- Footer -->
    <footer class="bg-gray-900 text-white py-4 text-center mt-auto">
    &copy; {{ date('Y') }} Coordinación de Confirmación - Todos los derechos reservados
  </footer>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
