<x-sidebar>
    <div class="container mx-auto py-8 px-4">
        <!-- Encabezado -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-200 pb-4 mb-6">
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="bi bi-wallet2 text-red-600 text-3xl"></i>
                Pagos de {{ $confirmando->nombre }}
            </h1>
            <a href="{{ route('pagos.create', $confirmando) }}"
               class="inline-flex items-center px-5 py-2 bg-green-600 text-white font-semibold rounded-xl shadow hover:bg-green-700 transition">
                <i class="bi bi-plus-circle mr-2"></i> Agregar Pago
            </a>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg flex items-center gap-2 shadow">
                <i class="bi bi-check-circle-fill text-green-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Info -->
        <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg shadow flex items-center gap-2 text-blue-800">
            <i class="bi bi-info-circle"></i>
            <span><strong>Total de Pagos Registrados:</strong> {{ $pagos->count() }}</span>
        </div>

        <!-- Tabla -->
        <div class="overflow-x-auto shadow rounded-lg border border-gray-200">
            <table class="min-w-full bg-white text-sm">
                <thead class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left"><i class="bi bi-calendar mr-1"></i> Fecha</th>
                        <th class="px-6 py-3 text-right"><i class="bi bi-currency-dollar mr-1"></i> Monto</th>
                        <th class="px-6 py-3 text-left"><i class="bi bi-layers mr-1"></i> Tipo</th>
                        <th class="px-6 py-3 text-left"><i class="bi bi-tags mr-1"></i> Método de Pago</th>
                        <th class="px-6 py-3 text-left"><i class="bi bi-receipt mr-1"></i> Boleta / Ref.</th>
                        <th class="px-6 py-3 text-left"><i class="bi bi-receipt-cutoff mr-1"></i> Físico</th>
                        <th class="px-6 py-3 text-left hidden md:table-cell"><i class="bi bi-chat-text mr-1"></i> Observación</th>
                        <th class="px-6 py-3 text-center"><i class="bi bi-tools mr-1"></i> Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($pagos as $pago)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 text-gray-600">{{ $pago->fecha }}</td>
                            <td class="px-6 py-3 font-bold text-right text-green-600">S/ {{ number_format($pago->monto, 2) }}</td>
                            <td class="px-6 py-3">
                                @php
                                    $typeColors = [
                                        'inscripcion' => 'bg-blue-100 text-blue-800 border border-blue-300',
                                        'mensualidad' => 'bg-green-100 text-green-800 border border-green-300',
                                        'extraordinario' => 'bg-yellow-100 text-yellow-800 border border-yellow-300',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $typeColors[$pago->tipo] ?? 'bg-gray-100 text-gray-800 border border-gray-300' }}">
                                    {{ ucfirst($pago->tipo) }}
                                </span>
                            </td>
                            <td class="px-6 py-3">
                                <span class="px-3 py-1 rounded-full text-xs bg-purple-100 text-purple-800 border border-purple-300 font-medium">
                                    {{ $pago->metodo_pago ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-3">{{ $pago->boleta ?? 'N/A' }}</td>
                            <td class="px-6 py-3">{{ $pago->fisico ?? 'N/A' }}</td>
                            <td class="px-6 py-3 hidden md:table-cell text-gray-600 text-sm truncate max-w-[200px]">
                                {{ $pago->observacion ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('pagos.edit', [$confirmando, $pago]) }}"
                                       class="px-3 py-1 bg-yellow-400 text-gray-900 rounded-md hover:bg-yellow-500 transition text-xs flex items-center gap-1"
                                       title="Editar">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form action="{{ route('pagos.destroy', [$confirmando, $pago]) }}" method="POST"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este pago?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition text-xs flex items-center gap-1"
                                                title="Eliminar">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-6 text-center text-gray-500">
                                <i class="bi bi-exclamation-octagon text-2xl block mb-2"></i>
                                No se encontraron pagos registrados para {{ $confirmando->nombre }}.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $pagos->links() }}
        </div>

        <!-- Botón Volver -->
        <div class="mt-6 border-t pt-4">
            <a href="{{ route('confirmandos.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 transition">
                <i class="bi bi-arrow-left mr-2"></i> Volver a {{ $confirmando->nombre }}
            </a>
        </div>
    </div>
</x-sidebar>
