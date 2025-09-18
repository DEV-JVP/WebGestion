<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">

                <h1 class="h3 fw-bold text-dark mb-4 border-bottom border-danger pb-3 d-flex align-items-center">
                    <i class="bi bi-person-badge fs-4 me-3 text-danger"></i>
                    Detalle del Confirmando
                </h1>

                <div class="row g-4">

                    <div class="col-12">
                        <h2 class="h5 text-primary fw-bold mb-3 border-bottom pb-2">Datos Personales</h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="mb-2"><strong class="text-secondary me-2">DNI:</strong> <span class="text-dark">{{ $confirmando->dni }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong class="text-secondary me-2">Nombre Completo:</strong> <span class="text-dark">{{ $confirmando->nombre }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong class="text-secondary me-2">Colegio:</strong> <span class="text-dark">{{ $confirmando->colegio ?? 'N/A' }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong class="text-secondary me-2">Capilla cercana:</strong> <span class="text-dark">{{ $confirmando->capilla_cercana ?? 'N/A' }}</span></p>
                            </div>
                            <div class="col-12">
                                <p class="mb-2"><strong class="text-secondary me-2">Dirección:</strong> <span class="text-dark">{{ $confirmando->direccion ?? 'N/A' }}</span></p>
                            </div>
                            <div class="col-12">
                                <p class="mb-2"><strong class="text-danger me-2">Contacto de emergencia:</strong> <span class="text-dark">{{ $confirmando->contacto_emergencia ?? 'N/A' }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12"><hr class="text-light"></div>

                    <div class="col-12">
                        <h2 class="h5 text-primary fw-bold mb-3 border-bottom pb-2">Información Eclesial</h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="mb-2"><strong class="text-secondary me-2">Comunidad/Grupo:</strong> <span class="text-dark">{{ $confirmando->comunidad?->nombre ?? 'No asignada' }}</span></p>
                            </div>
                            <div class="col-12">
                                <strong class="text-secondary me-2">Sacramentos recibidos:</strong>
                                @if ($confirmando->sacramentos->isNotEmpty())
                                    <div class="d-flex flex-wrap mt-2">
                                        @foreach ($confirmando->sacramentos as $sacramento)
                                            <span class="badge bg-success me-2 mb-2 p-2">
                                                <i class="bi bi-check-circle-fill me-1"></i>
                                                {{ $sacramento->nombre }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="badge bg-warning text-dark p-2">Ninguno registrado</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12"><hr class="text-light"></div>


                    <div class="col-12">
                        <h2 class="h5 text-primary fw-bold mb-3 border-bottom pb-2">Contacto Familiar (Detalle)</h2>
                        
                        <div class="accordion" id="accordionFamiliar">
                            
                            <div class="accordion-item shadow-sm">
                                <h2 class="accordion-header" id="headingPadre">
                                    <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePadre" aria-expanded="false" aria-controls="collapsePadre">
                                        <i class="bi bi-person me-2 text-info"></i> Datos del Padre
                                    </button>
                                </h2>
                                <div id="collapsePadre" class="accordion-collapse collapse" aria-labelledby="headingPadre" data-bs-parent="#accordionFamiliar">
                                    <div class="accordion-body bg-light">
                                        <p class="mb-2"><strong class="text-dark me-2">Nombre:</strong> {{ $confirmando->nombre_padre ?? 'N/A' }}</p>
                                        <p class="mb-0"><strong class="text-dark me-2">Teléfono:</strong> {{ $confirmando->telefono_padre ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="accordion-item shadow-sm">
                                <h2 class="accordion-header" id="headingMadre">
                                    <button class="accordion-button collapsed fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMadre" aria-expanded="false" aria-controls="collapseMadre">
                                        <i class="bi bi-person me-2 text-info"></i> Datos de la Madre
                                    </button>
                                </h2>
                                <div id="collapseMadre" class="accordion-collapse collapse" aria-labelledby="headingMadre" data-bs-parent="#accordionFamiliar">
                                    <div class="accordion-body bg-light">
                                        <p class="mb-2"><strong class="text-dark me-2">Nombre:</strong> {{ $confirmando->nombre_madre ?? 'N/A' }}</p>
                                        <p class="mb-0"><strong class="text-dark me-2">Teléfono:</strong> {{ $confirmando->telefono_madre ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 mt-4" x-data="{ expanded: false }">
                        <h2 class="h5 text-primary fw-bold mb-3 border-bottom pb-2">Observaciones</h2>
                        <div class="bg-light p-3 rounded border border-secondary shadow-sm">
                            <p class="text-dark mb-0" x-show="expanded || '{{ strlen($confirmando->observaciones) }}' < 200">
                                {{ $confirmando->observaciones ?? 'No hay observaciones.' }}
                            </p>
                            <p class="text-dark mb-0" x-show="!expanded && '{{ strlen($confirmando->observaciones) }}' > 200">
                                {{ \Illuminate\Support\Str::limit($confirmando->observaciones, 200) }}
                            </p>

                            @if (strlen($confirmando->observaciones) > 200)
                                <button type="button" @click="expanded = !expanded" class="btn btn-link btn-sm p-0 mt-2 text-primary">
                                    <span x-show="!expanded">Leer más...</span>
                                    <span x-show="expanded">Leer menos</span>
                                </button>
                            @endif
                        </div>
                    </div>

                </div> <div class="mt-5 pt-3 border-top d-flex justify-content-start">
                    <a href="{{ route('confirmandos.index') }}" class="btn btn-secondary me-3">
                        <i class="bi bi-arrow-left me-1"></i> Volver
                    </a>
                    <a href="{{ route('confirmandos.edit', $confirmando) }}" class="btn btn-warning text-dark shadow-sm">
                        <i class="bi bi-pencil-square me-1"></i> Editar
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-sidebar>