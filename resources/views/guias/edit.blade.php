<x-sidebar>
    <div class="max-w-2xl mx-auto p-6 bg-[#161b22] shadow-xl rounded-lg mt-6 border border-gray-700">
        <h1 class="text-3xl font-bold text-gray-100 mb-6 border-b border-gray-700 pb-4 flex items-center">
            <svg class="w-8 h-8 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            Editar Guía
        </h1>

        <form action="{{ route('guias.update', $guia) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                {{-- Nombre --}}
                <div>
                    <label for="nombre" class="block text-gray-400 flex items-center mb-1">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Nombre
                    </label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $guia->nombre) }}" class="w-full bg-[#21262d] text-gray-200 border-gray-700 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">
                </div>

                {{-- Teléfono --}}
                <div>
                    <label for="telefono" class="block text-gray-400 flex items-center mb-1">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        Teléfono
                    </label>
                    <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $guia->telefono) }}" class="w-full bg-[#21262d] text-gray-200 border-gray-700 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">
                </div>

                {{-- Comunidad --}}
                <div>
                    <label for="comunidad_id" class="block text-gray-400 flex items-center mb-1">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-4v-6h-2v6H7a2 2 0 01-2-2V9.814a1 1 0 01.383-.777l7-5.447a1 1 0 011.234 0l7 5.447a1 1 0 01.383.777V18a2 2 0 01-2 2z"></path></svg>
                        Comunidad
                    </label>
                    <select name="comunidad_id" id="comunidad_id" class="w-full bg-[#21262d] text-gray-200 border-gray-700 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50">
                        @foreach($comunidades as $comunidad)
                        <option value="{{ $comunidad->id }}" {{ $comunidad->id == old('comunidad_id', $guia->comunidad_id) ? 'selected' : '' }}>
                            {{ $comunidad->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Botones --}}
            <div class="flex justify-between mt-6 border-t border-gray-700 pt-6">
                <a href="{{ route('guias.index') }}" class="flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg shadow-md hover:bg-gray-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Cancelar
                </a>
                <button type="submit" class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Actualizar Guía
                </button>
            </div>
        </form>
    </div>
</x-sidebar>