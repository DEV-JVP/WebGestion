<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">

                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <h1 class="h3 fw-bold text-dark d-flex align-items-center">
                        <i class="bi bi-wallet2 fs-4 me-3 text-danger"></i>
                        Pagos de {{ $confirmando->nombre }}
                    </h1>
                    <a href="{{ route('pagos.create', $confirmando) }}" 
                       class="btn btn-danger shadow-sm d-flex align-items-center">
                        <i class="bi bi-plus-circle me-2"></i>
                        Agregar Pago
                    </a>
                </div>

                {{-- Mensaje de éxito (Opcional, si tienes sesiones de éxito) --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="alert alert-info border-0 shadow-sm mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    **Total de Pagos Registrados:** <span class="fw-bold">{{ $pagos->count() }}</span>
                </div>

                <div class="table-responsive rounded-3 shadow-sm">
                    <table class="table table-hover table-striped align-middle text-start mb-0">
                        <thead class="table-dark text-uppercase small">
                            <tr>
                                <th scope="col" class="px-3 py-2"><i class="bi bi-calendar me-1"></i> Fecha</th>
                                <th scope="col" class="px-3 py-2 text-end"><i class="bi bi-currency-dollar me-1"></i> Monto</th>
                                <th scope="col" class="px-3 py-2"><i class="bi bi-tag me-1"></i> Tipo</th>
                                <th scope="col" class="px-3 py-2"><i class="bi bi-receipt me-1"></i> Boleta/Ref.</th>
                                <th scope="col" class="px-3 py-2 d-none d-md-table-cell"><i class="bi bi-chat-text me-1"></i> Observación</th>
                                <th scope="col" class="px-3 py-2 text-center"><i class="bi bi-tools me-1"></i> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pagos as $pago)
                                <tr class="hover-bg-light">
                                    <td class="px-3 py-3 text-muted">{{ $pago->fecha }}</td>
                                    <td class="px-3 py-3 fw-bold text-end text-success">${{ number_format($pago->monto, 2) }}</td>
                                    <td class="px-3 py-3 text-capitalize">
                                        {{-- Badge para el tipo de pago --}}
                                        @php
                                            $typeClass = strtolower($pago->tipo) === 'efectivo' ? 'bg-primary' : 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $typeClass }}">{{ $pago->tipo }}</span>
                                    </td>
                                    <td class="px-3 py-3">{{ $pago->boleta }}</td>
                                    <td class="px-3 py-3 d-none d-md-table-cell text-truncate" style="max-width: 200px;">
                                        {{ $pago->observacion ?? 'N/A' }}
                                    </td>
                                    <td class="px-3 py-3 text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pagos.edit', [$confirmando, $pago]) }}" 
                                               class="btn btn-sm btn-warning text-white" 
                                               data-bs-toggle="tooltip" title="Editar">
                                                <i class="bi bi-pencil-square">Editar</i>
                                            </a>
                                            <form action="{{ route('pagos.destroy', [$confirmando, $pago]) }}" method="POST" 
                                                  onsubmit="return confirm('¿Estás seguro de que deseas eliminar este pago?');" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Eliminar">
                                                    <i class="bi bi-trash">Eliminar</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="bi bi-exclamation-octagon d-block mb-2 fs-4"></i>
                                        No se encontraron pagos registrados para **{{ $confirmando->nombre }}**.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{-- Usa el componente de paginación de Laravel, estilizado con Bootstrap 5 --}}
                    {{ $pagos->links('pagination::bootstrap-5') }}
                </div>
                
                <div class="mt-4 border-top pt-3">
                    <a href="{{ route('confirmandos.index', $confirmando) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i> Volver a {{ $confirmando->nombre }}
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-sidebar>