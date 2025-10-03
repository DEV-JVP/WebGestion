<x-sidebar>
    <div class="p-6">
        <div class="">

            <!-- Header dentro del mismo ancho -->
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 bg-transparent">
                <h1 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="bi bi-house-door-fill text-blue-900"></i>
                    Comunidades
                </h1>
                <div class="flex items-center gap-2">
                    <a href="{{ route('comunidades.designar') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-700 text-white rounded-lg shadow hover:bg-blue-800 transition">
                        <i class="bi bi-people-fill me-2"></i>
                        Designar
                    </a>
                    <a href="{{ route('comunidades.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                        <i class="bi bi-plus-circle me-2"></i>
                        Nueva
                    </a>
                </div>
            </div>

            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 flex items-center justify-between text-sm">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()">✕</button>
                </div>
            @endif

            <!-- Tabla -->
            <div class="overflow-x-auto shadow rounded-lg border border-gray-200 max-w-6xl mx-auto mt-4">
                <table class="w-full bg-white text-sm">
                    <thead class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-3 py-2"><i class="bi bi-person-circle me-1"></i> Nombre</th>
                            <th class="px-3 py-2 text-center"><i class="bi bi-chat-text me-1"></i> Comentarios</th>
                            <th class="px-3 py-2 text-center"><i class="bi bi-person-check-fill me-1"></i> Confirmandos</th>
                            <th class="px-3 py-2 text-center"><i class="bi bi-person-gear me-1"></i> Guías</th>
                            <th class="px-3 py-2 text-center"><i class="bi bi-tools me-1"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-transparent">
                        @forelse ($comunidades as $comunidad)
                            <tr class="hover:bg-gray-100/40 transition">
                                <td class="px-3 py-2 font-semibold text-gray-800">
                                    {{ $comunidad->nombre }}
                                </td>
                                <td class="px-3 py-2 text-gray-700 max-w-xs truncate">
                                    {{ $comunidad->comentario_coordinacion ?? 'Sin comentarios' }}
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded">
                                        {{ $comunidad->confirmandos->count() }}
                                    </span>
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <span class="px-2 py-1 text-xs font-semibold bg-gray-200 text-gray-700 rounded">
                                        {{ $comunidad->guias->count() }}
                                    </span>
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <div class="flex justify-center gap-1">
                                        <a href="{{ route('comunidades.show', $comunidad) }}"
                                           class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-xs"
                                           title="Ver Detalles">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('comunidades.edit', $comunidad) }}"
                                           class="px-2 py-1 bg-yellow-400 text-black rounded hover:bg-yellow-500 transition text-xs"
                                           title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('comunidades.destroy', $comunidad) }}" method="POST"
                                              onsubmit="return confirm('¿Estás seguro que deseas eliminar la comunidad {{ $comunidad->nombre }}?')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition text-xs"
                                                    title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                    <i class="bi bi-exclamation-octagon mb-2 block text-xl"></i>
                                    No hay comunidades registradas en el sistema.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-sidebar>
