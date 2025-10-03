<x-sidebar>
    <div class="max-w-4xl mx-auto my-10">
        <div class="bg-white/80 shadow-lg rounded-2xl p-8">

            <!-- Título -->
            <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4 flex items-center">
                <i class="bi bi-pencil-square text-yellow-600 text-2xl mr-3"></i>
                Editar Pago de <span class="ml-2 text-blue-700">{{ $confirmando->nombre }}</span>
            </h1>

            <!-- Errores -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 shadow">
                    <h4 class="font-bold">¡Ups! Hubo problemas con los datos:</h4>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario -->
            <form action="{{ route('pagos.update', [$confirmando, $pago]) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Monto -->
                    <div>
                        <label for="monto" class="block font-medium text-gray-700 mb-1">Monto *</label>
                        <input type="number" step="0.01" name="monto" id="monto"
                               value="{{ old('monto', $pago->monto) }}" required
                               class="w-full border rounded-md px-3 py-2">
                    </div>

                    <!-- Fecha -->
                    <div>
                        <label for="fecha" class="block font-medium text-gray-700 mb-1">Fecha *</label>
                        <input type="date" name="fecha" id="fecha"
                               value="{{ old('fecha', $pago->fecha) }}" required
                               class="w-full border rounded-md px-3 py-2">
                    </div>
                </div>

                <!-- Tipo de Pago -->
                <div>
                    <label for="tipo" class="block font-medium text-gray-700 mb-1">Tipo de Pago *</label>
                    <select name="tipo" id="tipo" required class="w-full border rounded-md px-3 py-2">
                        <option value="inscripcion" {{ old('tipo', $pago->tipo) == 'inscripcion' ? 'selected' : '' }}>Inscripción</option>
                        <option value="mensualidad" {{ old('tipo', $pago->tipo) == 'mensualidad' ? 'selected' : '' }}>Cuota</option>
                        <option value="extraordinario" {{ old('tipo', $pago->tipo) == 'extraordinario' ? 'selected' : '' }}>Extraordinario</option>
                    </select>
                </div>

                <!-- Método de Pago -->
                <div>
                    <label for="metodo_pago" class="block font-medium text-gray-700 mb-1">Método de Pago *</label>
                    <select name="metodo_pago" id="metodo_pago" required class="w-full border rounded-md px-3 py-2">
                        <option value="Transferencia Bancaria" {{ old('metodo_pago', $pago->metodo_pago) == 'Transferencia Bancaria' ? 'selected' : '' }}>Transferencia Bancaria</option>
                        <option value="Yape o Plin" {{ old('metodo_pago', $pago->metodo_pago) == 'Yape o Plin' ? 'selected' : '' }}>Yape o Plin</option>
                        <option value="Efectivo" {{ old('metodo_pago', $pago->metodo_pago) == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                    </select>
                </div>

                <!-- Boleta -->
                <div>
                    <label for="boleta" class="block font-medium text-gray-700 mb-1">Código transferencia / Boleta</label>
                    <input type="text" name="boleta" id="boleta"
                           value="{{ old('boleta', $pago->boleta) }}"
                           class="w-full border rounded-md px-3 py-2">
                </div>

                <!-- Físico -->
                <div>
                    <label for="fisico" class="block font-medium text-gray-700 mb-1">Boleta Físico</label>
                    <input type="text" name="fisico" id="fisico"
                           value="{{ old('fisico', $pago->fisico) }}"
                           class="w-full border rounded-md px-3 py-2">
                </div>

                <!-- Observación -->
                <div>
                    <label for="observacion" class="block font-medium text-gray-700 mb-1">Observación</label>
                    <textarea name="observacion" id="observacion" rows="3"
                              class="w-full border rounded-md px-3 py-2">{{ old('observacion', $pago->observacion) }}</textarea>
                </div>

                <!-- Botones -->
                <div class="flex justify-between pt-6 border-t">
                    <a href="{{ route('pagos.index', $confirmando) }}"
                       class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 flex items-center">
                        <i class="bi bi-arrow-left mr-2"></i> Cancelar
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg shadow flex items-center">
                        <i class="bi bi-save mr-2"></i> Actualizar Pago
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-sidebar>
