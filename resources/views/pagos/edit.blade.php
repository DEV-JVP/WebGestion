<x-sidebar>
    <div class="container my-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 p-md-5">

                <h1 class="h3 fw-bold text-dark mb-4 border-bottom border-danger pb-3 d-flex align-items-center">
                    <i class="bi bi-pencil-square fs-4 me-3 text-danger"></i>
                    Editar Pago de <span class="text-primary">{{ $confirmando->nombre }}</span>
                </h1>

                @if ($errors->any())
                    <div class="alert alert-danger mb-4 shadow-sm" role="alert">
                        <h4 class="alert-heading fs-6">¡Ups! Hubo problemas con los datos:</h4>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pagos.update', [$confirmando, $pago]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4 mb-4">
                        
                        <div class="col-md-6">
                            <label for="monto" class="form-label d-flex align-items-center">
                                <i class="bi bi-currency-dollar me-2 text-secondary"></i>
                                Monto <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input 
                                    type="number" 
                                    step="0.01" 
                                    name="monto" 
                                    id="monto" 
                                    value="{{ old('monto', $pago->monto) }}" 
                                    required 
                                    class="form-control @error('monto') is-invalid @enderror"
                                >
                            </div>
                            @error('monto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="fecha" class="form-label d-flex align-items-center">
                                <i class="bi bi-calendar me-2 text-secondary"></i>
                                Fecha <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="date" 
                                name="fecha" 
                                id="fecha" 
                                {{-- Asegura que la fecha esté en formato YYYY-MM-DD --}}
                                value="{{ old('fecha', \Carbon\Carbon::parse($pago->fecha)->format('Y-m-d')) }}" 
                                required
                                class="form-control @error('fecha') is-invalid @enderror"
                            >
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="col-12">
                            <label for="tipo" class="form-label d-flex align-items-center">
                                <i class="bi bi-tags me-2 text-secondary"></i>
                                Tipo de Pago <span class="text-danger">*</span>
                            </label>
                            <select 
                                name="tipo" 
                                id="tipo" 
                                required
                                class="form-select @error('tipo') is-invalid @enderror"
                            >
                                <option value="inscripcion" {{ old('tipo', $pago->tipo) == 'inscripcion' ? 'selected' : '' }}>Inscripción</option>
                                <option value="mensualidad" {{ old('tipo', $pago->tipo) == 'mensualidad' ? 'selected' : '' }}>Mensualidad</option>
                                <option value="extraordinario" {{ old('tipo', $pago->tipo) == 'extraordinario' ? 'selected' : '' }}>Extraordinario</option>
                            </select>
                            @error('tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="boleta" class="form-label d-flex align-items-center">
                                <i class="bi bi-receipt me-2 text-secondary"></i>
                                Boleta / Referencia (código o referencia de archivo)
                            </label>
                            <input 
                                type="text" 
                                name="boleta" 
                                id="boleta" 
                                value="{{ old('boleta', $pago->boleta) }}" 
                                placeholder="Código de boleta, transferencia o recibo"
                                class="form-control @error('boleta') is-invalid @enderror"
                            >
                            @error('boleta')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="observacion" class="form-label d-flex align-items-center">
                                <i class="bi bi-card-text me-2 text-secondary"></i>
                                Observación
                            </label>
                            <textarea 
                                name="observacion" 
                                id="observacion" 
                                rows="3" 
                                placeholder="Notas adicionales sobre el pago"
                                class="form-control @error('observacion') is-invalid @enderror"
                            >{{ old('observacion', $pago->observacion) }}</textarea>
                            @error('observacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-5 border-top pt-3">
                        <a href="{{ route('pagos.index', $confirmando) }}" class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="bi bi-arrow-left me-2"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-danger shadow-sm d-flex align-items-center">
                            <i class="bi bi-check2-circle me-2"></i>
                            Actualizar Pago
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-sidebar>