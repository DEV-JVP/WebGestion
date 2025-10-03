<x-sidebar>
    <div class="max-w-5xl mx-auto my-10">
        <div class="bg-white/70 backdrop-blur shadow-xl rounded-2xl border border-gray-200">
            <div class="p-8">

                <!-- Título -->
                <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center border-b pb-3">
                    <svg class="w-7 h-7 text-red-600 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-3.33 0-6 2.67-6 
                        6h12c0-3.33-2.67-6-6-6z"/>
                    </svg>
                    Detalle del Confirmando
                </h1>

                <!-- Datos Personales -->
                <section class="mb-8">
                    <h2 class="text-lg font-semibold text-blue-600 mb-3 border-b pb-2">Datos Personales</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach ([
                            'DNI' => $confirmando->dni,
                            'Nombre Completo' => $confirmando->nombre,
                            'Colegio' => $confirmando->colegio,
                            'Capilla cercana' => $confirmando->capilla_cercana,
                            'Dirección' => $confirmando->direccion,
                            'Contacto Personal' => $confirmando->contacto_emergencia,
                            'Tipo de Sangre' => $confirmando->tipo_sangre,
                            'Alergias' => $confirmando->alergias
                        ] as $label => $value)
                            <p class="text-gray-700">
                                <span class="font-medium text-gray-500">{{ $label }}:</span>
                                <span class="ml-1">{{ $value ?? 'N/A' }}</span>
                            </p>
                        @endforeach
                    </div>
                </section>

                <!-- Información Eclesial -->
                <section class="mb-8">
                    <h2 class="text-lg font-semibold text-blue-600 mb-3 border-b pb-2">Información Eclesial</h2>
                    <div class="space-y-3">
                        <p>
                            <span class="font-medium text-gray-500">Comunidad/Grupo:</span>
                            <span class="ml-1 text-gray-700">{{ $confirmando->comunidad?->nombre ?? 'No asignada' }}</span>
                        </p>
                        <div>
                            <span class="font-medium text-gray-500">Sacramentos recibidos:</span>
                            @if ($confirmando->sacramentos->isNotEmpty())
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @foreach ($confirmando->sacramentos as $sacramento)
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                            ✔ {{ $sacramento->nombre }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="ml-1 px-3 py-1 bg-yellow-100 text-yellow-700 rounded text-sm">Ninguno registrado</span>
                            @endif
                        </div>
                    </div>
                </section>

                <!-- Contacto Familiar -->
                <section class="mb-8">
                    <h2 class="text-lg font-semibold text-blue-600 mb-3 border-b pb-2">Contacto Familiar</h2>
                    <div x-data="{ open: null }" class="space-y-4">
                        @foreach (['Padre' => 'padre', 'Madre' => 'madre'] as $title => $key)
                            <div class="border rounded-lg shadow-sm">
                                <button 
                                    @click="open === '{{ $key }}' ? open = null : open = '{{ $key }}'"
                                    class="w-full flex justify-between items-center px-4 py-3 text-left font-semibold text-gray-700 hover:bg-gray-50">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 
                                            8 8s1.79 4 4 4zm0 2c-3.33 0-6 
                                            2.67-6 6h12c0-3.33-2.67-6-6-6z"/>
                                        </svg>
                                        Datos de la {{ $title }}
                                    </span>
                                    <svg class="w-5 h-5 text-gray-500" :class="open === '{{ $key }}' ? 'rotate-180' : ''"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div x-show="open === '{{ $key }}'" x-collapse class="px-4 py-3 bg-gray-50">
                                    <p class="text-gray-700"><span class="font-medium text-gray-500">Nombre:</span> {{ $confirmando->{'nombre_'.$key} ?? 'N/A' }}</p>
                                    <p class="text-gray-700"><span class="font-medium text-gray-500">Teléfono:</span> {{ $confirmando->{'telefono_'.$key} ?? 'N/A' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 space-y-2">
                        <p class="text-gray-700"><span class="font-medium text-gray-500">Situación Matrimonial:</span> {{ $confirmando->situacion_matrimonial_padres ?? 'N/A' }}</p>
                        @isset($confirmando->situacion_matrimonial_comentario)
                            <p class="text-gray-700"><span class="font-medium text-gray-500">Comentario:</span> {{ $confirmando->situacion_matrimonial_comentario }}</p>
                        @endisset
                    </div>
                </section>

                <!-- Observaciones -->
                <section class="mb-8" x-data="{ expanded: false }">
                    <h2 class="text-lg font-semibold text-blue-600 mb-3 border-b pb-2">Observaciones</h2>
                    @php $obs = $confirmando->observaciones ?? 'No hay observaciones.'; @endphp
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-inner">
                        <p class="text-gray-700" x-show="expanded || '{{ strlen($obs) }}' < 200">
                            {{ $obs }}
                        </p>
                        <p class="text-gray-700" x-show="!expanded && '{{ strlen($obs) }}' > 200">
                            {{ \Illuminate\Support\Str::limit($obs, 200) }}
                        </p>
                        @if (strlen($obs) > 200)
                            <button @click="expanded = !expanded" class="mt-2 text-blue-600 text-sm hover:underline">
                                <span x-show="!expanded">Leer más...</span>
                                <span x-show="expanded">Leer menos</span>
                            </button>
                        @endif
                    </div>
                </section>

                <!-- Acciones -->
                <div class="pt-6 border-t flex gap-3">
                    <a href="{{ route('confirmandos.index') }}"
                       class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">
                        ← Volver
                    </a>
                    <a href="{{ route('confirmandos.edit', $confirmando) }}"
                       class="px-4 py-2 rounded-lg bg-yellow-400 text-gray-900 font-semibold shadow hover:bg-yellow-500">
                        ✎ Editar
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-sidebar>
