<x-sidebar>
    <div class="max-w-5xl mx-auto my-10">
        <div class="bg-transparent shadow-xl rounded-2xl border border-gray-200">
            <div class="p-8">

                <!-- Título principal -->
                <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center border-b pb-3">
                    <svg class="w-8 h-8 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0h-3c-.504 0-1.026-.062-1.5-.16A11.01 11.01 0 0112 18a11.01 11.01 0 01-2.5.84C8.026 19.938 7.504 20 7 20H3z" />
                    </svg>
                    Registro de Confirmando
                </h1>

                <!-- Errores -->
                @if ($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded mb-6">
                    <p class="font-semibold mb-2">Por favor, corrija los siguientes errores:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('confirmandos.store') }}" method="POST" class="space-y-10">
                    @csrf

                    <!-- DATOS PERSONALES -->
                    <section>
                        <h3 class="text-lg font-semibold text-gray-600 border-b pb-2 mb-4">Datos Personales</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="dni" class="block font-medium text-gray-700">DNI <span class="text-red-500">*</span></label>
                                <input type="text" id="dni" name="dni" value="{{ old('dni') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    required maxlength="10" pattern="[0-9]*" inputmode="numeric" placeholder="Solo números, sin guiones">
                            </div>
                            <div>
                                <label for="nombre" class="block font-medium text-gray-700">Nombre completo <span class="text-red-500">*</span></label>
                                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    required autocomplete="name">
                            </div>
                            <div>
                                <label for="colegio" class="block font-medium text-gray-700">Colegio</label>
                                <input type="text" id="colegio" name="colegio" value="{{ old('colegio') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    placeholder="Nombre de la institución educativa">
                            </div>
                            <div>
                                <label for="capilla_cercana" class="block font-medium text-gray-700">Capilla cercana</label>
                                <input type="text" id="capilla_cercana" name="capilla_cercana" value="{{ old('capilla_cercana') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    placeholder="Parroquia o Capilla de referencia">
                            </div>
                            <div class="md:col-span-2">
                                <label for="direccion" class="block font-medium text-gray-700">Dirección</label>
                                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    placeholder="Calle, número, barrio/urbanización">
                            </div>
                            <div class="md:col-span-2">
                                <label for="contacto_emergencia" class="block font-medium text-gray-700">Contacto Personal</label>
                                <input type="text" id="contacto_emergencia" name="contacto_emergencia" value="{{ old('contacto_emergencia') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                            </div>
                        </div>
                    </section>

                    <!-- DATOS FAMILIARES -->
                    <section>
                        <h3 class="text-lg font-semibold text-gray-600 border-b pb-2 mb-4">Datos de Contacto Familiar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                                <p class="font-semibold text-gray-700 mb-3">Información del Padre</p>
                                <div class="space-y-3">
                                    <div>
                                        <label for="nombre_padre" class="block text-sm font-medium text-gray-600">Nombre</label>
                                        <input type="text" id="nombre_padre" name="nombre_padre" value="{{ old('nombre_padre') }}"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    </div>
                                    <div>
                                        <label for="telefono_padre" class="block text-sm font-medium text-gray-600">Teléfono</label>
                                        <input type="tel" id="telefono_padre" name="telefono_padre" value="{{ old('telefono_padre') }}"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                            placeholder="Ej: 987654321">
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                                <p class="font-semibold text-gray-700 mb-3">Información de la Madre</p>
                                <div class="space-y-3">
                                    <div>
                                        <label for="nombre_madre" class="block text-sm font-medium text-gray-600">Nombre</label>
                                        <input type="text" id="nombre_madre" name="nombre_madre" value="{{ old('nombre_madre') }}"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    </div>
                                    <div>
                                        <label for="telefono_madre" class="block text-sm font-medium text-gray-600">Teléfono</label>
                                        <input type="tel" id="telefono_madre" name="telefono_madre" value="{{ old('telefono_madre') }}"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                            placeholder="Ej: 987654321">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- INFORMACIÓN FAMILIAR ADICIONAL -->
                    <section>
                        <h3 class="text-lg font-semibold text-gray-600 border-b pb-2 mb-4">Información Familiar Adicional</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="situacion_matrimonial_padres" class="block font-medium text-gray-700">Situación matrimonial de los padres</label>
                                <select id="situacion_matrimonial_padres" name="situacion_matrimonial_padres" onchange="toggleComentario(this.value)"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <option value="">-- Seleccionar --</option>
                                    <option value="casados" {{ old('situacion_matrimonial_padres') == 'casados' ? 'selected' : '' }}>Casados</option>
                                    <option value="convivientes" {{ old('situacion_matrimonial_padres') == 'convivientes' ? 'selected' : '' }}>Convivientes</option>
                                    <option value="separados" {{ old('situacion_matrimonial_padres') == 'separados' ? 'selected' : '' }}>Separados</option>
                                    <option value="divorciados" {{ old('situacion_matrimonial_padres') == 'divorciados' ? 'selected' : '' }}>Divorciados</option>
                                    <option value="viudos" {{ old('situacion_matrimonial_padres') == 'viudos' ? 'selected' : '' }}>Viudos</option>
                                    <option value="otros" {{ old('situacion_matrimonial_padres') == 'otros' ? 'selected' : '' }}>Otros</option>
                                </select>
                            </div>
                            <div id="comentario_div" class="{{ old('situacion_matrimonial_padres') == 'otros' ? '' : 'hidden' }}">
                                <label for="situacion_matrimonial_comentario" class="block font-medium text-gray-700">Comentario</label>
                                <input type="text" id="situacion_matrimonial_comentario" name="situacion_matrimonial_comentario" value="{{ old('situacion_matrimonial_comentario') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    placeholder="Describa la situación">
                            </div>
                        </div>
                    </section>

                    <!-- INFORMACIÓN MÉDICA -->
                    <section>
                        <h3 class="text-lg font-semibold text-gray-600 border-b pb-2 mb-4">Información Médica</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="tipo_sangre" class="block font-medium text-gray-700">Tipo de sangre</label>
                                <input type="text" id="tipo_sangre" name="tipo_sangre" value="{{ old('tipo_sangre') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    placeholder="Ej: A+, O-">
                            </div>
                            <div>
                                <label for="alergias" class="block font-medium text-gray-700">Alergias</label>
                                <input type="text" id="alergias" name="alergias" value="{{ old('alergias') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                    placeholder="Ej: Penicilina, polen, etc.">
                            </div>
                        </div>
                    </section>

                    <!-- INFORMACIÓN ECLESIAL -->
                    <section>
                        <h3 class="text-lg font-semibold text-gray-600 border-b pb-2 mb-4">Información Eclesial</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="comunidad_id" class="block font-medium text-gray-700">Comunidad</label>
                                <select id="comunidad_id" name="comunidad_id"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                                    <option value="">-- Seleccionar comunidad --</option>
                                    @foreach ($comunidades as $comunidad)
                                    <option value="{{ $comunidad->id }}" {{ old('comunidad_id') == $comunidad->id ? 'selected' : '' }}>
                                        {{ $comunidad->nombre }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 mb-2">Sacramentos recibidos</label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($sacramentos as $sacramento)
                                    <label class="flex items-center space-x-2 px-3 py-1 border rounded-lg cursor-pointer hover:bg-gray-100">
                                        <input type="checkbox" id="sacramento_{{ $sacramento->id }}" name="sacramentos[]" value="{{ $sacramento->id }}"
                                            {{ collect(old('sacramentos'))->contains($sacramento->id) ? 'checked' : '' }}
                                            class="text-blue-600 focus:ring-blue-500 rounded">
                                        <span>{{ $sacramento->nombre }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- OBSERVACIONES -->
                    <section>
                        <h3 class="text-lg font-semibold text-gray-600 border-b pb-2 mb-4">Observaciones</h3>
                        <div>
                            <label for="observaciones" class="block font-medium text-gray-700">Notas Adicionales</label>
                            <textarea id="observaciones" name="observaciones" rows="4"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                                placeholder="Cualquier información relevante para el proceso de confirmación">{{ old('observaciones') }}</textarea>
                        </div>
                    </section>

                    <!-- BOTONES -->
                    <div class="flex justify-between items-center pt-6 border-t">
                        <a href="{{ route('confirmandos.index') }}"
                           class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="px-6 py-2 rounded-lg bg-blue-600 text-white font-semibold shadow hover:bg-blue-700">
                            Guardar Confirmando
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function toggleComentario(valor) {
            let div = document.getElementById('comentario_div');
            div.classList.toggle('hidden', valor !== 'otros');
        }
    </script>
</x-sidebar>
