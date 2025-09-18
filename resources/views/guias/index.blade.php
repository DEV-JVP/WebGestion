<x-sidebar>
    <div class="max-w-6xl mx-auto p-6 bg-[#161b22] shadow-xl rounded-lg mt-6 border border-gray-700">
        <div class="flex justify-between items-center mb-6 border-b border-gray-700 pb-4">
            <h1 class="text-3xl font-bold text-gray-100 flex items-center">
                <svg class="w-8 h-8 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Guías
            </h1>
            <a href="{{ route('guias.create') }}" class="flex items-center px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Nueva Guía
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-red-900/40 text-red-300 border border-red-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="w-full text-left text-gray-300">
                <thead class="bg-[#21262d] text-gray-400 border-b border-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">Nombre</th>
                        <th scope="col" class="px-6 py-3 font-medium">Teléfono</th>
                        <th scope="col" class="px-6 py-3 font-medium">Comunidad</th>
                        <th scope="col" class="px-6 py-3 font-medium text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-[#161b22] divide-y divide-gray-700">
                    @forelse ($guias as $guia)
                    <tr class="hover:bg-gray-800 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $guia->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $guia->telefono }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $guia->comunidad->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap flex justify-center items-center gap-2">
                        
                            <a href="{{ route('guias.edit', $guia) }}" class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Editar
                            </a>
                            <form action="{{ route('guias.destroy', $guia) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar a esta guía?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.36 21H7.64a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay guías registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-sidebar>