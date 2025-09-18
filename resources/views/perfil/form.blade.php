 <script src="https://cdn.tailwindcss.com"></script>
    <div class="max-w-md mx-auto mt-6 p-6 bg-[#161b22] rounded-lg shadow-xl border border-gray-700">
        <h1 class="text-3xl font-bold text-gray-100 mb-6 border-b border-gray-700 pb-4 flex items-center justify-center">
            <svg class="w-8 h-8 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            Consulta de Perfil
        </h1>

        <form action="{{ route('perfil.search') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="dni" class="block mb-2 text-gray-400">Ingrese su DNI:</label>
                <input type="text" name="dni" id="dni" class="w-full bg-[#21262d] text-gray-200 border-gray-700 rounded-lg shadow-sm focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50" required>
                @error('dni')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full mt-4 px-4 py-2 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 transition-colors duration-200 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Consultar
            </button>
        </form>
    </div>
