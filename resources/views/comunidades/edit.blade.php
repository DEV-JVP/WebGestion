<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">

                <h1 class="h3 fw-bold text-dark mb-4 border-bottom border-danger pb-3 d-flex align-items-center">
                    <i class="bi bi-pencil-square fs-4 me-3 text-danger"></i>
                    Editar Comunidad
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

                <form action="{{ route('comunidades.update', $comunidad) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4 mb-4">
                        
                        <div class="col-12">
                            <label for="nombre" class="form-label d-flex align-items-center">
                                <i class="bi bi-tag me-2 text-secondary"></i>
                                Nombre de la Comunidad <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nombre" 
                                id="nombre" 
                                value="{{ old('nombre', $comunidad->nombre) }}" 
                                required
                                placeholder="Ej: Comunidad San Pedro"
                                class="form-control @error('nombre') is-invalid @enderror"
                            >
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="comentario_coordinacion" class="form-label d-flex align-items-center">
                                <i class="bi bi-card-text me-2 text-secondary"></i>
                                Comentarios de coordinación
                            </label>
                            <textarea 
                                name="comentario_coordinacion" 
                                id="comentario_coordinacion" 
                                rows="4" 
                                placeholder="Notas o detalles importantes para la coordinación."
                                class="form-control @error('comentario_coordinacion') is-invalid @enderror"
                            >{{ old('comentario_coordinacion', $comunidad->comentario_coordinacion) }}</textarea>
                            @error('comentario_coordinacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5 border-top pt-3">
                        <a href="{{ route('comunidades.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="bi bi-arrow-left me-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-danger shadow-sm d-flex align-items-center">
                            <i class="bi bi-check2-circle me-2"></i>
                            Actualizar Comunidad
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-sidebar>