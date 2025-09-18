<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">

                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <h1 class="h3 fw-bold text-dark d-flex align-items-center">
                        <i class="bi bi-house-door-fill fs-4 me-3 text-danger"></i> 
                        Comunidades
                    </h1>
                    <div class="d-flex align-items-center space-x-2">
                        <a href="{{ route('comunidades.designar') }}" 
                           class="btn btn-primary shadow-sm d-flex align-items-center me-2">
                            <i class="bi bi-people-fill me-2"></i>
                            Designar Comunidades
                        </a>
                        <a href="{{ route('comunidades.create') }}" 
                           class="btn btn-danger shadow-sm d-flex align-items-center">
                            <i class="bi bi-plus-circle me-2"></i>
                            Nueva Comunidad
                        </a>
                    </div>
                </div>

                {{-- Mensaje de éxito --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive rounded-3 shadow-sm">
                    <table class="table table-hover table-striped align-middle text-start mb-0">
                        <thead class="table-dark text-uppercase small">
                            <tr>
                                <th scope="col" class="px-3 py-2"><i class="bi bi-person-circle me-1"></i> Nombre</th>
                                <th scope="col" class="px-3 py-2 d-none d-md-table-cell"><i class="bi bi-chat-text me-1"></i> Comentarios Coordinación</th>
                                <th scope="col" class="px-3 py-2 text-center"><i class="bi bi-person-check-fill me-1"></i> Confirmandos</th>
                                <th scope="col" class="px-3 py-2 text-center"><i class="bi bi-person-gear me-1"></i> Guías</th>
                                <th scope="col" class="px-3 py-2 text-center"><i class="bi bi-tools me-1"></i> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($comunidades as $comunidad)
                                <tr class="hover-bg-light">
                                    <td class="px-3 py-3 fw-bold">{{ $comunidad->nombre }}</td>
                                    <td class="px-3 py-3 text-muted d-none d-md-table-cell text-truncate" style="max-width: 250px;">
                                        {{ $comunidad->comentario_coordinacion ?? 'Sin comentarios' }}
                                    </td>
                                    <td class="px-3 py-3 text-center">
                                        <span class="badge bg-info text-dark">{{ $comunidad->confirmandos->count() }}</span>
                                    </td>
                                    <td class="px-3 py-3 text-center">
                                        <span class="badge bg-secondary">{{ $comunidad->guias->count() }}</span>
                                    </td>
                                    <td class="px-3 py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('comunidades.show', $comunidad) }}" 
                                               class="btn btn-sm btn-info text-white" 
                                               data-bs-toggle="tooltip" title="Ver Detalles">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('comunidades.edit', $comunidad) }}" 
                                               class="btn btn-sm btn-warning text-dark" 
                                               data-bs-toggle="tooltip" title="Editar">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('comunidades.destroy', $comunidad) }}" method="POST" 
                                                  onsubmit="return confirm('¿Estás seguro de que deseas eliminar la comunidad {{ $comunidad->nombre }}? Esta acción es irreversible.');" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Eliminar">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-exclamation-octagon d-block mb-2 fs-4"></i>
                                        No hay comunidades registradas en el sistema.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-sidebar>