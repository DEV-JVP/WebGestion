<x-sidebar>
    <div class="max-w-7xl mx-auto py-10">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

            <!-- Filtros -->
            <div class="px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-200 bg-gray-50 rounded-t-lg">

                <!-- Búsqueda -->
                <form method="GET" action="{{ route('documentos.index') }}" class="flex gap-2 w-full md:w-auto">
                    <input type="text" name="search" value="{{ $search ?? '' }}"
                        placeholder="Buscar confirmando..."
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 hover:scale-105 transition transform duration-200 ease-in-out text-sm">
                        <i class="bi bi-search me-2"></i> Buscar
                    </button>
                </form>

                <!-- Filtro por Comunidad -->
                <form method="GET" action="{{ route('documentos.index') }}" class="w-full md:w-auto">
                    <select name="comunidad_id" onchange="this.form.submit()"
                        class="w-full md:w-auto px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
                        <option value="">Todas las comunidades</option>
                        @foreach($comunidades as $comunidad)
                        <option value="{{ $comunidad->id }}" {{ request('comunidad_id') == $comunidad->id ? 'selected' : '' }}>
                            {{ $comunidad->nombre }}
                        </option>
                        @endforeach
                    </select>
                </form>




                <!-- Exportar CSV -->
                <a href="{{ route('documentos.export.csv') }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 hover:scale-105 transition transform duration-200 ease-in-out text-sm">
                    <i class="bi bi-file-earmark-spreadsheet me-2"></i> Exportar CSV
                </a>

                <!-- Selector por página -->
                <form method="GET" action="{{ route('documentos.index') }}" class="w-full md:w-auto">
                    <select name="per_page" onchange="this.form.submit()"
                        class="w-full md:w-auto px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
                        <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5 por página</option>
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 por página</option>
                        <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20 por página</option>
                    </select>
                </form>
            </div>


            <!-- Tabla -->
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3">Confirmando</th>
                            <th scope="col" class="px-3 py-2"> Comunidad</th>
                            <th class="px-6 py-3">DNI Confirmando</th>
                            <th class="px-6 py-3">Partida Bautizo</th>
                            <th class="px-6 py-3">DNI Padrino</th>
                            <th class="px-6 py-3">Constancia Confirmación</th>
                            <th class="px-6 py-3">Partida Matrimonio Religioso</th>
                           
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($documentos as $doc)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $doc->confirmando->nombre }}
                            </td>
                            <td class="px-3 py-3">
                                <span class="inline-block bg-gradient-to-r from-indigo-200 to-indigo-400 text-indigo-900 font-bold rounded-full px-3 py-1 shadow-md">
                                    {{ $doc->confirmando->comunidad->nombre ?? '-' }}
                                </span>
                            </td>





                            <td class="px-6 py-4">
                                {!! $doc->dni_confirmando
                                ? '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Entregado</span>'
                                : '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">Falta</span>' !!}
                            </td>
                            <td class="px-6 py-4">
                                {!! $doc->partida_bautizo
                                ? '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Entregado</span>'
                                : '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">Falta</span>' !!}
                            </td>
                            <td class="px-6 py-4">
                                {!! $doc->dni_padrino
                                ? '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Entregado</span>'
                                : '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">Falta</span>' !!}
                            </td>
                            <td class="px-6 py-4">
                                {!! $doc->constancia_confirmacion
                                ? '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Entregado</span>'
                                : '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">Falta</span>' !!}
                            </td>
                            <td class="px-6 py-4">
                                {!! $doc->partida_matrimonio_religioso
                                ? '<span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Entregado</span>'
                                : '<span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">Falta</span>' !!}
                            </td>
                         
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                <i class="bi bi-exclamation-octagon text-2xl block mb-2"></i>
                                No hay documentación registrada.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $documentos->appends(['search' => $search, 'per_page' => $perPage])->links() }}
            </div>
        </div>
    </div>
</x-sidebar>