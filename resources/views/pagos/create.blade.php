<x-sidebar>
    <div class="max-w-4xl mx-auto my-10">
        <div class="bg-white/80 shadow-lg rounded-2xl p-8">

            <!-- Título -->
            <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4 flex items-center">
                <i class="bi bi-plus-circle text-green-600 text-2xl mr-3"></i>
                Registrar Pago para <span class="ml-2 text-blue-700">{{ $confirmando->nombre }}</span>
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
            <form action="{{ route('pagos.store', $confirmando) }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Monto -->
                    <div>
                        <label for="monto" class="block font-medium text-gray-700 mb-1">
                            <i class="bi bi-currency-dollar text-gray-500 mr-1"></i> Monto *
                        </label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 bg-gray-100 border border-r-0 rounded-l-md text-gray-600">$</span>
                            <input type="number" step="0.01" name="monto" id="monto"
                                   value="{{ old('monto') }}" required
                                   placeholder="Ej: 50.00"
                                   class="w-full border rounded-r-md px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('monto') border-red-500 @enderror">
                        </div>
                        @error('monto') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Fecha -->
                    <div>
                        <label for="fecha" class="block font-medium text-gray-700 mb-1">
                            <i class="bi bi-calendar text-gray-500 mr-1"></i> Fecha *
                        </label>
                        <input type="date" name="fecha" id="fecha"
                               value="{{ old('fecha', date('Y-m-d')) }}" required
                               class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('fecha') border-red-500 @enderror">
                        @error('fecha') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Tipo de Pago -->
                <div>
                    <label for="tipo" class="block font-medium text-gray-700 mb-1">
                        <i class="bi bi-tags text-gray-500 mr-1"></i> Tipo de Pago *
                    </label>
                    <select name="tipo" id="tipo" required
                            class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('tipo') border-red-500 @enderror">
                        <option value="" disabled selected>-- Seleccionar tipo --</option>
                        <option value="inscripcion" {{ old('tipo') == 'inscripcion' ? 'selected' : '' }}>Inscripción</option>
                        <option value="mensualidad" {{ old('tipo') == 'mensualidad' ? 'selected' : '' }}>Cuota</option>
                        <option value="extraordinario" {{ old('tipo') == 'extraordinario' ? 'selected' : '' }}>Extraordinario</option>
                    </select>
                    @error('tipo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Método de Pago -->
                <div>
                    <label for="metodo_pago" class="block font-medium text-gray-700 mb-1">
                        <i class="bi bi-credit-card text-gray-500 mr-1"></i> Método de Pago *
                    </label>
                    <select name="metodo_pago" id="metodo_pago" required
                            class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('metodo_pago') border-red-500 @enderror">
                        <option value="" disabled selected>-- Seleccionar método --</option>
                        <option value="Transferencia Bancaria" {{ old('metodo_pago') == 'Transferencia Bancaria' ? 'selected' : '' }}>Transferencia Bancaria</option>
                        <option value="Yape o Plin" {{ old('metodo_pago') == 'Yape o Plin' ? 'selected' : '' }}>Yape o Plin</option>
                        <option value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                    </select>
                    @error('metodo_pago') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Boleta -->
                <div>
                    <label for="boleta" class="block font-medium text-gray-700 mb-1">
                        <i class="bi bi-receipt text-gray-500 mr-1"></i> Código transferencia / Boleta
                    </label>
                    <input type="text" name="boleta" id="boleta"
                           value="{{ old('boleta') }}" placeholder="Ej: 12345ABC o BOLETA"
                           class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('boleta') border-red-500 @enderror">
                    @error('boleta') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Físico -->
                <div>
                    <label for="fisico" class="block font-medium text-gray-700 mb-1">
                        <i class="bi bi-receipt text-gray-500 mr-1"></i> Boleta Entregable Físico (Código)
                    </label>
                    <input type="text" name="fisico" id="fisico" value="{{ old('fisico') }}"
                           class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('fisico') border-red-500 @enderror">
                    @error('fisico') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Observación -->
                <div>
                    <label for="observacion" class="block font-medium text-gray-700 mb-1">
                        <i class="bi bi-card-text text-gray-500 mr-1"></i> Observación
                    </label>
                    <textarea name="observacion" id="observacion" rows="3"
                              placeholder="Notas adicionales sobre el pago"
                              class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 @error('observacion') border-red-500 @enderror">{{ old('observacion') }}</textarea>
                    @error('observacion') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Botones -->
                <div class="flex justify-between pt-6 border-t">
                    <a href="{{ route('pagos.index', $confirmando) }}"
                       class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg shadow hover:bg-gray-300 flex items-center">
                        <i class="bi bi-arrow-left mr-2"></i> Cancelar
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow flex items-center">
                        <i class="bi bi-check2-circle mr-2"></i> Registrar Pago
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-sidebar>
