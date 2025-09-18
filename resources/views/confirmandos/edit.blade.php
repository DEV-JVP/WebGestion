<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border border-secondary rounded-3">
            <div class="card-body p-4 p-md-5">

                <h1 class="h3 fw-bold text-dark mb-4 border-bottom pb-3 d-flex align-items-center">
                    <svg class="me-3 text-danger" width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Editar Confirmando
                </h1>

                {{-- Mostrar errores de validación --}}
                @if ($errors->any())
                <div class="alert alert-danger mb-4 shadow-sm" role="alert">
                    <h4 class="alert-heading fs-5">¡Ups! Hubo algunos problemas con tu formulario:</h4>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('confirmandos.update', $confirmando->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h3 class="h5 text-primary mb-3 border-bottom pb-2">Datos Personales</h3>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="dni" class="form-label">DNI <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="dni"
                                id="dni"
                                value="{{ old('dni', $confirmando->dni) }}"
                                required
                                maxlength="10"
                                pattern="[0-9]*"
                                inputmode="numeric"
                                placeholder="Solo números"
                                class="form-control"
                            >
                        </div>
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="nombre"
                                id="nombre"
                                value="{{ old('nombre', $confirmando->nombre) }}"
                                required
                                autocomplete="name"
                                placeholder="Nombre(s) y Apellido(s)"
                                class="form-control"
                            >
                        </div>
                        <div class="col-md-6">
                            <label for="colegio" class="form-label">Colegio / Institución</label>
                            <input type="text" name="colegio" id="colegio" value="{{ old('colegio', $confirmando->colegio) }}" placeholder="Nombre del colegio o parroquia" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="capilla_cercana" class="form-label">Capilla Cercana</label>
                            <input type="text" name="capilla_cercana" id="capilla_cercana" value="{{ old('capilla_cercana', $confirmando->capilla_cercana) }}" placeholder="Capilla o Parroquia de referencia" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="direccion" class="form-label">Dirección Domiciliaria</label>
                            <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $confirmando->direccion) }}" placeholder="Calle, número, ciudad/localidad" class="form-control">
                        </div>
                    </div>

                    <h3 class="h5 text-primary mb-3 border-bottom pb-2">Datos de Contacto Familiar</h3>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="card card-body bg-light border-0 shadow-sm">
                                <p class="fw-bold text-dark mb-3 border-bottom pb-2">Información del Padre</p>
                                <div class="mb-3">
                                    <label for="nombre_padre" class="form-label">Nombre</label>
                                    <input type="text" name="nombre_padre" id="nombre_padre" value="{{ old('nombre_padre', $confirmando->nombre_padre) }}" class="form-control">
                                </div>
                                <div>
                                    <label for="telefono_padre" class="form-label">Teléfono</label>
                                    <input type="tel" name="telefono_padre" id="telefono_padre" value="{{ old('telefono_padre', $confirmando->telefono_padre) }}" inputmode="numeric" placeholder="Ej: 987654321" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-body bg-light border-0 shadow-sm">
                                <p class="fw-bold text-dark mb-3 border-bottom pb-2">Información de la Madre</p>
                                <div class="mb-3">
                                    <label for="nombre_madre" class="form-label">Nombre</label>
                                    <input type="text" name="nombre_madre" id="nombre_madre" value="{{ old('nombre_madre', $confirmando->nombre_madre) }}" class="form-control">
                                </div>
                                <div>
                                    <label for="telefono_madre" class="form-label">Teléfono</label>
                                    <input type="tel" name="telefono_madre" id="telefono_madre" value="{{ old('telefono_madre', $confirmando->telefono_madre) }}" inputmode="numeric" placeholder="Ej: 987654321" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="contacto_emergencia" class="form-label">Contacto de Emergencia (Nombre y Teléfono)</label>
                            <input type="text" name="contacto_emergencia" id="contacto_emergencia" value="{{ old('contacto_emergencia', $confirmando->contacto_emergencia) }}" placeholder="Ej: Abuela, 912345678" class="form-control">
                        </div>
                    </div>

                    <h3 class="h5 text-primary mb-3 border-bottom pb-2">Información Eclesial</h3>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="comunidad_id" class="form-label">Comunidad / Grupo</label>
                            <select name="comunidad_id" id="comunidad_id" class="form-select">
                                <option value="">-- Seleccionar comunidad --</option>
                                @foreach ($comunidades as $comunidad)
                                    @php
                                        $isSelected = old('comunidad_id', $confirmando->comunidad_id) == $comunidad->id;
                                    @endphp
                                    <option value="{{ $comunidad->id }}" {{ $isSelected ? 'selected' : '' }}>
                                        {{ $comunidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="sacramentos" class="form-label">Sacramentos recibidos</label>
                            <select name="sacramentos[]" id="sacramentos" multiple class="form-select" style="height: 120px;">
                                @foreach ($sacramentos as $sacramento)
                                    @php
                                        // Obtener los IDs de sacramentos del modelo
                                        $currentSacramentos = $confirmando->sacramentos->pluck('id')->toArray();
                                        // Comprobar si está seleccionado (usando old o el valor actual)
                                        $isSelected = in_array($sacramento->id, old('sacramentos', $currentSacramentos));
                                    @endphp
                                    <option value="{{ $sacramento->id }}" {{ $isSelected ? 'selected' : '' }}>
                                        {{ $sacramento->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Mantén presionado `Ctrl` o `Cmd` para seleccionar varios.</div>
                        </div>
                    </div>

                    <h3 class="h5 text-primary mb-3 border-bottom pb-2">Observaciones y Notas</h3>
                    <div class="mb-4">
                        <label for="observaciones" class="form-label">Observaciones Adicionales</label>
                        <textarea name="observaciones" id="observaciones" rows="5" placeholder="Notas sobre el historial eclesial, necesidades especiales, etc." class="form-control">{{ old('observaciones', $confirmando->observaciones) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end space-x-2 border-top pt-3">
                        <a href="{{ route('confirmandos.index') }}" class="btn btn-outline-secondary me-2">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-danger shadow-sm">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-sidebar>