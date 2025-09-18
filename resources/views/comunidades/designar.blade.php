<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">

                <h1 class="h3 fw-bold text-dark mb-4 border-bottom border-danger pb-3 d-flex align-items-center">
                    <i class="bi bi-people-fill fs-4 me-3 text-danger"></i>
                    Designar Confirmandos a Comunidades
                </h1>

                <p class="text-muted mb-4">
                    Asigna una comunidad a cada confirmando usando la lista desplegable. Si no se selecciona ninguna, el confirmando se considerará "Sin asignar".
                </p>

                <form action="{{ route('comunidades.guardarDesignacion') }}" method="POST">
                    @csrf

                    <div class="table-responsive rounded-3 shadow-sm mb-4">
                        <table class="table table-hover table-striped align-middle text-start mb-0">
                            <thead class="table-dark text-uppercase small">
                                <tr>
                                    <th scope="col" class="px-3 py-2"><i class="bi bi-person-vcard me-1"></i> Nombre del Confirmando</th>
                                    <th scope="col" class="px-3 py-2 d-none d-sm-table-cell"><i class="bi bi-credit-card me-1"></i> DNI</th>
                                    <th scope="col" class="px-3 py-2 text-center" style="min-width: 200px;"><i class="bi bi-house me-1"></i> Comunidad a Asignar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($confirmandos as $confirmando)
                                <tr class="hover-bg-light">
                                    <td class="px-3 py-3 fw-bold">{{ $confirmando->nombre }}</td>
                                    <td class="px-3 py-3 d-none d-sm-table-cell text-muted">{{ $confirmando->dni }}</td>
                                    <td class="px-3 py-3">
                                        <select 
                                            name="confirmandos[{{ $confirmando->id }}]" 
                                            class="form-select @error("confirmandos.{$confirmando->id}") is-invalid @enderror"
                                        >
                                            <option value="">-- Sin asignar --</option>
                                            @foreach($comunidades as $comunidad)
                                                <option 
                                                    value="{{ $comunidad->id }}" 
                                                    @if(old("confirmandos.{$confirmando->id}", $confirmando->comunidad_id) == $comunidad->id) selected @endif
                                                >
                                                    {{ $comunidad->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error("confirmandos.{$confirmando->id}")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-5 border-top pt-3">
                        <a href="{{ route('comunidades.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="bi bi-arrow-left me-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-danger shadow-sm d-flex align-items-center">
                            <i class="bi bi-check2-circle me-2"></i>
                            Guardar Asignaciones
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-sidebar>