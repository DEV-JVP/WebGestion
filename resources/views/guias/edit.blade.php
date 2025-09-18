<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">

                <h1 class="h3 fw-bold text-dark mb-4 border-bottom border-danger pb-3 d-flex align-items-center">
                    <i class="bi bi-person-gear fs-4 me-3 text-danger"></i>
                    Editar Guía
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

                <form action="{{ route('guias.update', $guia) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4 mb-4">
                        
                        <div class="col-12">
                            <label for="nombre" class="form-label d-flex align-items-center">
                                <i class="bi bi-person-vcard me-2 text-secondary"></i>
                                Nombre <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nombre" 
                                id="nombre" 
                                value="{{ old('nombre', $guia->nombre) }}" 
                                required
                                placeholder="Nombre completo del guía"
                                class="form-control @error('nombre') is-invalid @enderror"
                            >
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="telefono" class="form-label d-flex align-items-center">
                                <i class="bi bi-phone me-2 text-secondary"></i>
                                Teléfono
                            </label>
                            <input 
                                type="text" 
                                name="telefono" 
                                id="telefono" 
                                value="{{ old('telefono', $guia->telefono) }}" 
                                placeholder="Ej: 555-1234567"
                                class="form-control @error('telefono') is-invalid @enderror"
                            >
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="comunidad_id" class="form-label d-flex align-items-center">
                                <i class="bi bi-house me-2 text-secondary"></i>
                                Comunidad Asignada <span class="text-danger">*</span>
                            </label>
                            <select 
                                name="comunidad_id" 
                                id="comunidad_id" 
                                required
                                class="form-select @error('comunidad_id') is-invalid @enderror"
                            >
                                <option value="" disabled>Seleccione una comunidad</option>
                                @foreach($comunidades as $comunidad)
                                    <option value="{{ $comunidad->id }}" 
                                        {{ $comunidad->id == old('comunidad_id', $guia->comunidad_id) ? 'selected' : '' }}>
                                        {{ $comunidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('comunidad_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5 border-top pt-3">
                        <a href="{{ route('guias.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="bi bi-arrow-left me-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-danger shadow-sm d-flex align-items-center">
                            <i class="bi bi-check2-circle me-2"></i>
                            Actualizar Guía
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-sidebar>