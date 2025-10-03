<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">

                <h1 class="h3 fw-bold text-dark mb-4 border-bottom border-danger pb-3 d-flex align-items-center">
                    <i class="bi bi-file-earmark-text-fill fs-4 me-3 text-danger"></i>
                    Documentación de {{ $confirmando->nombre }}
                </h1>

                <form action="{{ route('documentos.update', $confirmando) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Documentación del Confirmando --}}
                    <h5 class="fw-bold text-dark mt-4 mb-3">Documentación del Confirmando</h5>
                    <div class="form-check mb-2">
                        <input type="checkbox" 
                               name="dni_confirmando" 
                               id="dni_confirmando"
                               class="form-check-input"
                               {{ $documentos->dni_confirmando ?? false ? 'checked' : '' }}>
                        <label class="form-check-label" for="dni_confirmando">
                            Copia de DNI del confirmando
                        </label>
                    </div>
                    <div class="form-check mb-4">
                        <input type="checkbox" 
                               name="partida_bautizo" 
                               id="partida_bautizo"
                               class="form-check-input"
                               {{ $documentos->partida_bautizo ?? false ? 'checked' : '' }}>
                        <label class="form-check-label" for="partida_bautizo">
                            Partida original de Bautizo (Vigente)
                        </label>
                    </div>

                    {{-- Documentación del Padrino/Madrina --}}
                    <h5 class="fw-bold text-dark mt-4 mb-3">Documentación del Padrino o Madrina</h5>
                    <div class="form-check mb-2">
                        <input type="checkbox" 
                               name="dni_padrino" 
                               id="dni_padrino"
                               class="form-check-input"
                               {{ $documentos->dni_padrino ?? false ? 'checked' : '' }}>
                        <label class="form-check-label" for="dni_padrino">
                            Copia de DNI
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" 
                               name="constancia_confirmacion" 
                               id="constancia_confirmacion"
                               class="form-check-input"
                               {{ $documentos->constancia_confirmacion ?? false ? 'checked' : '' }}>
                        <label class="form-check-label" for="constancia_confirmacion">
                            Constancia de confirmación (si es soltero y no convive)
                        </label>
                    </div>
                    <div class="form-check mb-4">
                        <input type="checkbox" 
                               name="partida_matrimonio_religioso" 
                               id="partida_matrimonio_religioso"
                               class="form-check-input"
                               {{ $documentos->partida_matrimonio_religioso ?? false ? 'checked' : '' }}>
                        <label class="form-check-label" for="partida_matrimonio_religioso">
                            Partida de matrimonio religioso (si es casado)
                        </label>
                    </div>

                    <div class="d-flex justify-content-between mt-5 border-top pt-3">
                        <a href="{{ route('documentos.index', $confirmando) }}" class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="bi bi-arrow-left me-2"></i>
                            Volver
                        </a>
                        <button type="submit" class="btn btn-danger shadow-sm d-flex align-items-center">
                            <i class="bi bi-check2-circle me-2"></i>
                            Guardar Documentos
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-sidebar>
