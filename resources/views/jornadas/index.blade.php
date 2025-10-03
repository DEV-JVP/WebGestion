<x-sidebar>
    <div class="container mx-auto my-5">
        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">
            <div class="p-6">


                <!-- Filtros y Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-200 pb-4 mb-6">

                    <!-- Título -->
                    <h1 class="text-2xl font-extrabold text-gray-900 flex items-center">
                        <i class="bi bi-calendar-event text-blue-600 text-2xl me-3"></i>
                        Jornadas
                    </h1>

                    <!-- Contenedor de filtros y acciones -->
                    <div class="flex flex-col md:flex-row gap-3 md:gap-4 items-center w-full md:w-auto">

                        <!-- Búsqueda -->
                        <form method="GET" action="{{ route('jornadas.index') }}" class="flex gap-2 w-full md:w-auto">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Buscar jornada..."
                                class="flex-1 px-3 py-2 border rounded-lg text-sm focus:ring focus:ring-red-200">
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 hover:scale-105 transition transform duration-200 ease-in-out text-sm">
                                <i class="bi bi-search me-2"></i> Buscar
                            </button>
                        </form>

                        <!-- Selector por página -->
                        <form method="GET" action="{{ route('jornadas.index') }}">
                            <select name="per_page" onchange="this.form.submit()"
                                class="px-3 py-2 border rounded-lg text-sm focus:ring focus:ring-red-200">
                                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 por página</option>
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 por página</option>
                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 por página</option>
                            </select>
                        </form>

                        <!-- Botón para crear nueva jornada -->
                        <a href="{{ route('jornadas.create') }}"
                            class="inline-flex items-center px-5 py-2 bg-green-600 text-white font-bold rounded-xl shadow hover:bg-green-700 transition text-sm">
                            <i class="bi bi-plus-circle me-2"></i> Nueva Jornada
                        </a>

                    </div>
                </div>

                <!-- Tabla de Jornadas -->
                <div class="overflow-x-auto rounded-xl shadow-lg">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-6 py-3">Fecha</th>
                                <th class="px-6 py-3">Tema</th>
                                <th class="px-6 py-3 text-center">Asistencias</th>
                                <th class="px-6 py-3 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse($jornadas as $jornada)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="px-6 py-3 font-bold">{{ $jornada->fecha }}</td>
                                <td class="px-6 py-3 text-gray-500">{{ $jornada->tema }}</td>
                                <td class="px-6 py-3 text-center">
                                    <a href="{{ route('asistencias.edit', $jornada) }}"
                                        class="inline-flex items-center px-4 py-1 bg-blue-600 text-white font-semibold rounded-xl shadow hover:bg-blue-700 transition text-xs">
                                        <i class="bi bi-card-checklist me-1"></i> Registrar / Ver
                                    </a>
                                </td>
                                <td class="px-6 py-3 text-center">
                                    <div class="inline-flex gap-2">
                                        <a href="{{ route('jornadas.edit', $jornada) }}"
                                            class="px-3 py-1 bg-yellow-400 text-gray-900 rounded-lg shadow hover:bg-yellow-500 transition text-xs font-semibold">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('jornadas.destroy', $jornada) }}" method="POST"
                                            onsubmit="return confirm('¿Eliminar jornada: {{ $jornada->tema }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition text-xs font-bold">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-gray-400">
                                    <i class="bi bi-exclamation-octagon d-block mb-2 text-2xl"></i>
                                    No hay jornadas registradas.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-sidebar>