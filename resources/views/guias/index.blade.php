<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">

                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <h1 class="h3 fw-bold text-dark d-flex align-items-center">
                        <i class="bi bi-people-fill fs-4 me-3 text-danger"></i>
                        Guías
                    </h1>
                    <a href="{{ route('guias.create') }}" 
                       class="btn btn-danger shadow-sm d-flex align-items-center">
                        <i class="bi bi-plus-circle me-2"></i>
                        Nueva Guía
                    </a>
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
                                <th scope="col" class="px-3 py-2"><i class="bi bi-person-vcard me-1"></i> Nombre</th>
                                <th scope="col" class="px-3 py-2"><i class="bi bi-phone me-1"></i> Teléfono</th>
                                <th scope="col" class="px-3 py-2"><i class="bi bi-house me-1"></i> Comunidad Asignada</th>
                                <th scope="col" class="px-3 py-2 text-center"><i class="bi bi-tools me-1"></i> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($guias as $guia)
                            <tr class="hover-bg-light">
                                <td class="px-3 py-3 fw-bold">{{ $guia->nombre }}</td>
                                <td class="px-3 py-3 text-muted">{{ $guia->telefono }}</td>
                                <td class="px-3 py-3">
                                    <span class="badge bg-primary">{{ $guia->comunidad->nombre }}</span>
                                </td>
                                
                                <td class="px-3 py-3 text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('guias.edit', $guia) }}" 
                                           class="btn btn-sm btn-warning text-dark" 
                                           data-bs-toggle="tooltip" title="Editar Guía">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('guias.destroy', $guia) }}" method="POST" 
                                              onsubmit="return confirm('¿Estás seguro de que deseas eliminar al guía {{ $guia->nombre }}?');" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Eliminar Guía">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="bi bi-exclamation-octagon d-block mb-2 fs-4"></i>
                                    No hay guías registradas en el sistema.
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