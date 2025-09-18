<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">

                <h1 class="h3 fw-bold text-dark mb-4 border-bottom border-danger pb-3 d-flex align-items-center">
                    <i class="bi bi-card-checklist fs-4 me-3 text-danger"></i>
                    Asistencias - {{ $jornada->fecha }} (<span class="text-primary">{{ $jornada->tema }}</span>)
                </h1>

                <p class="text-muted mb-4">Selecciona el estado de asistencia para cada confirmando.</p>
                
                {{-- Mensaje de éxito/error (opcional) --}}
                @if(session('success'))
                    <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Se han guardado las asistencias correctamente.
                    </div>
                @endif
                
                <form action="{{ route('asistencias.update', $jornada) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="table-responsive rounded-3 shadow-sm mb-4">
                        <table class="table table-striped align-middle text-start mb-0">
                            <thead class="table-dark text-uppercase small">
                                <tr>
                                    <th scope="col" class="px-3 py-2"><i class="bi bi-person me-1"></i> Confirmando</th>
                                    <th scope="col" class="px-3 py-2"><i class="bi bi-house me-1"></i> Comunidad</th>
                                    <th scope="col" class="px-3 py-2 text-center text-success">Asistió</th>
                                    <th scope="col" class="px-3 py-2 text-warning">Tardanza</th>
                                    <th scope="col" class="px-3 py-2 text-info">F. Justificada</th>
                                    <th scope="col" class="px-3 py-2 text-danger">F. Sin Justificar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($confirmandos as $confirmando)
                                <tr class="hover-bg-light">
                                    <td class="px-3 py-3 fw-bold">{{ $confirmando->nombre }}</td>
                                    <td class="px-3 py-3 text-muted">{{ $confirmando->comunidad?->nombre ?? 'Sin comunidad' }}</td>
                                    
                                    @php
                                        // Obtener el estado de la asistencia actual
                                        $estado = $asistencias[$confirmando->id]->estado ?? '';
                                    @endphp
                                    
                                    <td class="text-center">
                                        <div class="form-check d-inline-block">
                                            <input type="radio" name="asistencias[{{ $confirmando->id }}]" value="asistio" {{ $estado=='asistio'?'checked':'' }} class="form-check-input border-success">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-inline-block">
                                            <input type="radio" name="asistencias[{{ $confirmando->id }}]" value="tardanza" {{ $estado=='tardanza'?'checked':'' }} class="form-check-input border-warning">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-inline-block">
                                            <input type="radio" name="asistencias[{{ $confirmando->id }}]" value="falta_justificada" {{ $estado=='falta_justificada'?'checked':'' }} class="form-check-input border-info">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check d-inline-block">
                                            <input type="radio" name="asistencias[{{ $confirmando->id }}]" value="falta_sin_justificar" {{ $estado=='falta_sin_justificar'?'checked':'' }} class="form-check-input border-danger">
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-5 border-top pt-3">
                         <a href="{{ route('jornadas.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="bi bi-arrow-left me-2"></i>
                            Volver a Jornadas
                        </a>
                        <button type="submit" class="btn btn-danger shadow-sm d-flex align-items-center">
                            <i class="bi bi-check2-circle me-2"></i>
                            Guardar Asistencias
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-sidebar>