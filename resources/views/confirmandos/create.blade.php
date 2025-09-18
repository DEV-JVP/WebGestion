<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg rounded-3 border-light"> <div class="card-body p-4 p-md-5">

                <h1 class="h3 fw-bold text-dark mb-4 border-bottom pb-3 d-flex align-items-center">
                    <svg class="me-2 text-primary" width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0h-3c-.504 0-1.026-.062-1.5-.16A11.01 11.01 0 0112 18a11.01 11.01 0 01-2.5.84C8.026 19.938 7.504 20 7 20H3z" />
                    </svg>
                    Registro de Confirmando
                </h1>

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <p class="fw-bold mb-1">Por favor, corrija los siguientes errores:</p>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('confirmandos.store') }}" method="POST">
                    @csrf

                    <h3 class="h5 text-secondary mb-3 border-bottom pb-2">Datos Personales</h3>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="dni" class="form-label">DNI <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                id="dni"
                                name="dni"
                                value="{{ old('dni') }}"
                                required
                                maxlength="10" {{-- Ajusta la longitud según el país --}}
                                pattern="[0-9]*"
                                inputmode="numeric"
                                placeholder="Solo números, sin guiones"
                            >
                        </div>
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre completo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required autocomplete="name">
                        </div>
                        <div class="col-md-6">
                            <label for="colegio" class="form-label">Colegio</label>
                            <input type="text" class="form-control" id="colegio" name="colegio" value="{{ old('colegio') }}" placeholder="Nombre de la institución educativa">
                        </div>
                        <div class="col-md-6">
                            <label for="capilla_cercana" class="form-label">Capilla cercana</label>
                            <input type="text" class="form-control" id="capilla_cercana" name="capilla_cercana" value="{{ old('capilla_cercana') }}" placeholder="Parroquia o Capilla de referencia">
                        </div>
                        <div class="col-12">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}" placeholder="Calle, número, barrio/urbanización">
                        </div>
                    </div>

                    <h3 class="h5 text-secondary mb-3 border-bottom pb-2">Datos de Contacto Familiar</h3>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="card card-body bg-light h-100 border-0">
                                <p class="fw-bold text-dark mb-3">Información del Padre</p>
                                <div class="mb-3">
                                    <label for="nombre_padre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_padre" name="nombre_padre" value="{{ old('nombre_padre') }}" autocomplete="given-name">
                                </div>
                                <div>
                                    <label for="telefono_padre" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" id="telefono_padre" name="telefono_padre" value="{{ old('telefono_padre') }}" inputmode="numeric" placeholder="Ej: 987654321">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-body bg-light h-100 border-0">
                                <p class="fw-bold text-dark mb-3">Información de la Madre</p>
                                <div class="mb-3">
                                    <label for="nombre_madre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_madre" name="nombre_madre" value="{{ old('nombre_madre') }}" autocomplete="given-name">
                                </div>
                                <div>
                                    <label for="telefono_madre" class="form-label">Teléfono</label>
                                    <input type="tel" class="form-control" id="telefono_madre" name="telefono_madre" value="{{ old('telefono_madre') }}" inputmode="numeric" placeholder="Ej: 987654321">
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="h5 text-secondary mb-3 border-bottom pb-2">Información Eclesial</h3>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="comunidad_id" class="form-label">Comunidad</label>
                            <select class="form-select" id="comunidad_id" name="comunidad_id">
                                <option value="">-- Seleccionar comunidad --</option>
                                @foreach ($comunidades as $comunidad)
                                    <option value="{{ $comunidad->id }}" {{ old('comunidad_id') == $comunidad->id ? 'selected' : '' }}>
                                        {{ $comunidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- Considerar aquí añadir una librería JS (como Select2) para una búsqueda fácil si hay muchas opciones --}}
                        </div>

                        <div class="col-md-6">
                            <label class="form-label d-block">Sacramentos recibidos</label>
                            <div class="p-2 border rounded-3">
                                @foreach ($sacramentos as $sacramento)
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="sacramentos[]"
                                            id="sacramento_{{ $sacramento->id }}"
                                            value="{{ $sacramento->id }}"
                                            {{ (collect(old('sacramentos'))->contains($sacramento->id)) ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label" for="sacramento_{{ $sacramento->id }}">
                                            {{ $sacramento->nombre }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <h3 class="h5 text-secondary mb-3 border-bottom pb-2">Observaciones</h3>
                    <div class="mb-4">
                        <label for="observaciones" class="form-label">Notas Adicionales</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="4" placeholder="Cualquier información relevante para el proceso de confirmación">{{ old('observaciones') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between border-top pt-3">
                        <a href="{{ route('confirmandos.index') }}" class="btn btn-outline-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary shadow-sm">
                            Guardar Confirmando
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-sidebar>