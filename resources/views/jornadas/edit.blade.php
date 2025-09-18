<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">

                <h1 class="h3 fw-bold text-dark mb-4 border-bottom border-danger pb-3 d-flex align-items-center">
                    <i class="bi bi-pencil-square fs-4 me-3 text-danger"></i>
                    Editar Jornada
                </h1>

                @if ($errors->any())
                    <div class="alert alert-danger mb-4 shadow-sm" role="alert">
                        <h4 class="alert-heading fs-6">¡Ups! Hubo problemas con los datos:</h4>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jornadas.update', $jornada) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4 mb-4">
                        
                        <div class="col-12">
                            <label for="fecha" class="form-label d-flex align-items-center">
                                <i class="bi bi-calendar-date me-2 text-secondary"></i>
                                Fecha de la Jornada <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="date" 
                                name="fecha" 
                                id="fecha" 
                                value="{{ old('fecha', $jornada->fecha) }}" 
                                required
                                class="form-control @error('fecha') is-invalid @enderror"
                            >
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="tema" class="form-label d-flex align-items-center">
                                <i class="bi bi-book me-2 text-secondary"></i>
                                Tema de la Jornada <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="tema" 
                                id="tema" 
                                value="{{ old('tema', $jornada->tema) }}" 
                                required
                                placeholder="Ej: La oración como camino personal"
                                class="form-control @error('tema') is-invalid @enderror"
                            >
                            @error('tema')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5 border-top pt-3">
                        <a href="{{ route('jornadas.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="bi bi-arrow-left me-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-danger shadow-sm d-flex align-items-center">
                            <i class="bi bi-check2-circle me-2"></i>
                            Actualizar Jornada
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-sidebar>