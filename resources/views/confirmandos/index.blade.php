<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Confirmandos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        .table-custom-header {
            background-color: #343a40 !important; /* Gris oscuro para el encabezado */
            color: white;
        }
        .btn-action-group .btn {
            border-radius: 0;
        }
        .btn-action-group .btn:first-child {
            border-top-left-radius: .3rem;
            border-bottom-left-radius: .3rem;
        }
        .btn-action-group .btn:last-child {
            border-top-right-radius: .3rem;
            border-bottom-right-radius: .3rem;
        }
    </style>
</head>
<body class="bg-light">

<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">
                
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <h1 class="h3 fw-bold text-dark d-flex align-items-center">
                        <i class="bi bi-people-fill fs-4 me-3 text-danger"></i> 
                        Listado de Confirmandos
                    </h1>
                    <a href="{{ route('confirmandos.create') }}" 
                       class="btn btn-danger shadow-sm d-flex align-items-center">
                        <i class="bi bi-plus-circle me-2"></i>
                        Nuevo Confirmando
                    </a>
                </div>

                {{-- Mensaje de éxito (Mejorado con un icono) --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle text-start">
                        <thead class="table-custom-header text-uppercase small">
                            <tr>
                                <th scope="col"><i class="bi bi-credit-card me-1"></i> DNI</th>
                                <th scope="col"><i class="bi bi-person me-1"></i> Nombre</th>
                                <th scope="col"><i class="bi bi-building me-1"></i> Colegio</th>
                                <th scope="col"><i class="bi bi-house me-1"></i> Comunidad</th>
                                <th scope="col" class="text-center"><i class="bi bi-cash me-1"></i> Estado de Pagos</th>
                                <th scope="col" class="text-end"><i class="bi bi-tools me-1"></i> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($confirmandos as $confirmando)
                                <tr>
                                    <td class="fw-bold">{{ $confirmando->dni }}</td>
                                    <td>{{ $confirmando->nombre }}</td>
                                    <td>{{ $confirmando->colegio ?? 'N/A' }}</td>
                                    <td>{{ $confirmando->comunidad?->nombre ?? 'No asignada' }}</td>
                                    
                                    <td class="text-center">
                                        @php
                                            $pagoCount = $confirmando->pagos->count();
                                            $badgeClass = $pagoCount > 0 ? 'bg-success' : 'bg-warning text-dark';
                                            $icon = $pagoCount > 0 ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
                                            $text = $pagoCount > 0 ? 'Pagos (' . $pagoCount . ')' : 'Pendiente';
                                        @endphp
                                        <span class="badge {{ $badgeClass }} fw-bold p-2">
                                            <i class="bi {{ $icon }} me-1"></i>
                                            {{ $text }}
                                        </span>
                                    </td>
                                    
                                    <td class="text-end">
                                        <div class="btn-group btn-action-group" role="group">
                                            <a href="{{ route('confirmandos.show', $confirmando) }}" 
                                               class="btn btn-sm btn-info text-white" 
                                               data-bs-toggle="tooltip" title="Ver Detalles">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('confirmandos.edit', $confirmando) }}" 
                                               class="btn btn-sm btn-warning text-dark" 
                                               data-bs-toggle="tooltip" title="Editar Registro">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="{{ route('pagos.index', $confirmando) }}" 
                                               class="btn btn-sm btn-secondary" 
                                               data-bs-toggle="tooltip" title="Gestionar Pagos">
                                                <i class="bi bi-currency-dollar"></i>
                                            </a>
                                            <form action="{{ route('confirmandos.destroy', $confirmando) }}" method="POST" 
                                                  onsubmit="return confirm('¿Seguro que deseas eliminar a {{ $confirmando->nombre }}? Esta acción es irreversible.')">
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
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="bi bi-emoji-frown fs-4 d-block mb-2"></i>
                                        No se encontraron confirmandos registrados en el sistema.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{-- Si usas $confirmandos = Confirmando::paginate(10); --}}
                    {{-- {{ $confirmandos->links('pagination::bootstrap-5') }} --}}
                </div>

            </div>
        </div>
    </div>
</x-sidebar>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
</body>
</html>