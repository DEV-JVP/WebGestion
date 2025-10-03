<x-sidebar>
    <div class="p-6">
        <div class="">

            <!-- Header -->
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 bg-transparent max-w-6xl mx-auto w-full">
                <h1 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="bi bi-people-fill text-blue-900 text-2xl"></i>
                    Equipo de Guías
                </h1>
                <a href="{{ route('guias.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-700 text-white font-semibold rounded-lg shadow hover:bg-blue-800 transition">
                    <i class="bi bi-plus-circle me-2"></i>
                    Nuevo Guía
                </a>
            </div>

            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 flex items-center justify-between text-sm max-w-6xl mx-auto mt-3 rounded-lg">
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
                            <th class="px-3 py-3 text-left"><i class="bi bi-person-vcard me-1"></i> Nombre</th>
                            <th class="px-3 py-3 text-left"><i class="bi bi-phone me-1"></i> Teléfono</th>
                            <th class="px-3 py-3 text-left"><i class="bi bi-house me-1"></i> Comunidad</th>
                            <th class="px-3 py-3 text-left"><i class="bi bi-award me-1"></i> Cargo</th>
                            <th class="px-3 py-3 text-center"><i class="bi bi-tools me-1"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-transparent">
                        @forelse ($guias as $guia)
                            <tr class="hover:bg-gray-100/40 transition">
                                <!-- Nombre -->
                                <td class="px-3 py-3 font-semibold text-gray-800">
                                    {{ $guia->nombre }}
                                </td>
                                <!-- Teléfono -->
                                <td class="px-3 py-3 text-gray-700">
                                    {{ $guia->telefono }}
                                </td>
                                <!-- Comunidad -->
                                <td class="px-3 py-3">
                                    <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded">
                                        {{ $guia->comunidad->nombre }}
                                    </span>
                                </td>
                                <!-- Cargo -->
                                <td class="px-3 py-3">
                                    <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">
                                        {{ $guia->tipo_cargo }}
                                    </span>
                                </td>
                                <!-- Acciones -->
                                <td class="px-3 py-3 text-center">
                                    <div class="flex justify-center gap-1">
                                        <a href="{{ route('guias.edit', $guia) }}"
                                           class="px-2 py-1 bg-yellow-400 text-black rounded hover:bg-yellow-500 transition text-xs"
                                           title="Editar Guía">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('guias.destroy', $guia) }}" method="POST"
                                              onsubmit="return confirm('¿Estás seguro de que deseas eliminar al guía {{ $guia->nombre }}?')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition text-xs"
                                                    title="Eliminar Guía">
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
                                    No hay guías registrados en el sistema.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-sidebar>
