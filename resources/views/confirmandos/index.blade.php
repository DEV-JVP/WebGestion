<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Confirmandos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <x-sidebar>
        <div class="container mx-auto py-8 px-4">

            <!-- Encabezado -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-200 pb-4 mb-6">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="bi bi-people-fill text-blue-600 text-3xl"></i>
                    Listado de Confirmandos
                </h1>
                <a href="{{ route('confirmandos.create') }}"
                    class="inline-flex items-center px-5 py-2 bg-green-600 text-white font-semibold rounded-xl shadow hover:bg-green-700 transition">
                    <i class="bi bi-plus-circle me-2"></i> Nuevo Confirmando
                </a>
            </div>

            <!-- Mensaje de éxito -->
            @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg flex items-center gap-2">
                <i class="bi bi-check-circle-fill text-green-600"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            <!-- Tabla -->
            <div class="overflow-x-auto shadow rounded-lg border border-gray-200">
                <table class="min-w-full bg-white text-sm">
                    <thead class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left"><i class="bi bi-credit-card me-1"></i> DNI</th>
                            <th class="px-6 py-3 text-left"><i class="bi bi-person me-1"></i> Nombre</th>
                            <th class="px-6 py-3 text-left"><i class="bi bi-building me-1"></i> Colegio</th>
                            <th class="px-6 py-3 text-left"><i class="bi bi-house me-1"></i> Comunidad</th>
                            <th class="px-6 py-3 text-center"><i class="bi bi-cash me-1"></i> Estado de Pagos</th>
                            <th class="px-6 py-3 text-center"><i class="bi bi-tools me-1"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($confirmandos as $confirmando)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 font-bold text-gray-700">{{ $confirmando->dni }}</td>
                            <td class="px-6 py-3">{{ $confirmando->nombre }}</td>
                            <td class="px-6 py-3">{{ $confirmando->colegio ?? 'N/A' }}</td>
                            <td class="px-6 py-3">{{ $confirmando->comunidad?->nombre ?? 'No asignada' }}</td>

                            <td class="px-6 py-3 text-center">
                                @php
                                $pagoCount = $confirmando->pagos->count();
                                $badgeClass = $pagoCount > 0
                                ? 'bg-green-100 text-green-800 border border-green-300'
                                : 'bg-yellow-100 text-yellow-800 border border-yellow-300';
                                $icon = $pagoCount > 0 ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
                                $text = $pagoCount > 0 ? 'Pagos (' . $pagoCount . ')' : 'Pendiente';
                                @endphp
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold {{ $badgeClass }}">
                                    <i class="bi {{ $icon }}"></i> {{ $text }}
                                </span>
                            </td>

                            <td class="px-6 py-3 text-center">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('confirmandos.show', $confirmando) }}"
                                        class="px-3 py-1 bg-sky-600 text-white rounded-md hover:bg-sky-700 transition text-xs"
                                        title="Ver Detalles">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('confirmandos.edit', $confirmando) }}"
                                        class="px-3 py-1 bg-yellow-400 text-gray-900 rounded-md hover:bg-yellow-500 transition text-xs"
                                        title="Editar Registro">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="{{ route('pagos.index', $confirmando) }}"
                                        class="px-3 py-1 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition text-xs"
                                        title="Gestionar Pagos">
                                        <i class="bi bi-currency-dollar"></i>
                                    </a>


                                    <a href="{{ route('confirmandos.documentos.edit', [$confirmando->id, $confirmando->documentos->first()?->id ?? 0]) }}"
   class="px-3 py-1 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition text-xs"
   title="Gestionar Documentos">
    <i class="bi bi-folder-check"></i>
</a>






                                    <form action="{{ route('confirmandos.destroy', $confirmando) }}" method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar a {{ $confirmando->nombre }}? Esta acción es irreversible.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition text-xs"
                                            title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                                <i class="bi bi-emoji-frown text-2xl block mb-2"></i>
                                No se encontraron confirmandos registrados en el sistema.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-6">
                {{ $confirmandos->links() }}
            </div>

        </div>
    </x-sidebar>

</body>

</html>