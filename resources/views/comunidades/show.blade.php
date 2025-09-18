<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">

                <h1 class="h3 fw-bold text-dark mb-4 border-bottom border-danger pb-3 d-flex align-items-center">
                    <i class="bi bi-house-door-fill fs-4 me-3 text-danger"></i>
                    Comunidad: <span class="text-primary">{{ $comunidad->nombre }}</span>
                </h1>

                <div class="mb-5">
                    <h2 class="h5 fw-semibold text-danger mb-3 d-flex align-items-center">
                        <i class="bi bi-info-circle me-2"></i> Detalles Generales
                    </h2>
                    <div class="card border-light shadow-sm">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-secondary">Comentarios de coordinación:</strong> 
                                <span class="text-dark">{{ $comunidad->comentario_coordinacion ?? 'N/A' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-secondary">Total de Guías:</strong> 
                                <span class="badge bg-secondary rounded-pill">{{ $comunidad->guias->count() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong class="text-secondary">Total de Confirmandos:</strong> 
                                <span class="badge bg-info text-dark rounded-pill">{{ $comunidad->confirmandos->count() }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-5">
                    <h2 class="h5 fw-semibold text-danger mb-3 border-bottom border-gray-300 pb-2 d-flex align-items-center">
                        <i class="bi bi-person-gear me-2"></i> Guías Asignados
                    </h2>
                    <ul class="list-group list-group-flush shadow-sm">
                        @forelse($comunidad->guias as $guia)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-person me-2 text-primary"></i>
                                    {{ $guia->nombre }}
                                </div>
                                <small class="text-muted">
                                    Teléfono: {{ $guia->telefono ?? 'N/A' }}
                                </small>
                            </li>
                        @empty
                            <li class="list-group-item text-muted text-center py-3">No hay guías asignados a esta comunidad.</li>
                        @endforelse
                    </ul>
                </div>
                
                <div class="mt-5">
                    <h2 class="h5 fw-semibold text-danger mb-3 border-bottom border-gray-300 pb-2 d-flex align-items-center">
                        <i class="bi bi-person-check-fill me-2"></i> Confirmandos Asignados
                    </h2>
                    <ul class="list-group list-group-flush shadow-sm">
                        @forelse($comunidad->confirmandos as $confirmando)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="bi bi-person me-2 text-primary"></i>
                                    {{ $confirmando->nombre }}
                                </div>
                                <small class="text-muted">
                                    DNI: {{ $confirmando->dni }}
                                </small>
                            </li>
                        @empty
                            <li class="list-group-item text-muted text-center py-3">No hay confirmandos asignados a esta comunidad.</li>
                        @endforelse
                    </ul>
                </div>

                <div class="mt-5 pt-4 border-top">
                    <a href="{{ route('comunidades.index') }}" class="btn btn-outline-secondary d-flex align-items-center w-auto">
                        <i class="bi bi-arrow-left me-2"></i>
                        Volver al Listado
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-sidebar>