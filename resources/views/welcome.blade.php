<!DOCTYPE html>
<html lang="en">




</head>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navegación</title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

   
    @vite(['resources/js/app.js', 'resources/css/app.css'])
  <style>
    body {
      margin: 0;
      font-family: "Open Sans", sans-serif;
      background: linear-gradient(to right top, #8e44ad 0%, #3498db 100%);
      height: 100vh;
    }

    nav {
      max-width: 960px;
      margin: 80px auto; /* más abajo y centrado */
      background: linear-gradient(
        90deg,
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0.2) 25%,
        rgba(255, 255, 255, 0.2) 75%,
        rgba(255, 255, 255, 0) 100%
      );
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.1),
                  inset 0 0 1px rgba(189, 5, 5, 0.6);
      padding: 15px 0;
      border-radius: 8px;
      text-align: center;
    }

    nav ul {
      margin: 0;
      padding: 0;
      list-style: none;
    }

    nav ul li {
      display: inline-block;
    }

   nav ul li a {
  padding: 15px 20px;
  text-transform: uppercase;
  color: rgba(0, 0, 0, 0.7);
  font-size: 18px;
  font-weight: bold !important;  /* 👈 fuerza la negrita */
  text-decoration: none;
  display: block;
  transition: all 0.3s ease;
}

nav ul li a:hover {
  background: rgba(255, 255, 255, 0.15);
  border-radius: 6px;
  color: rgba(1, 12, 43, 1);
}

   
  </style>
</head>
<body>
<nav>
  <ul class="nav justify-content-center">
    <li class="nav-item">
      <a class="nav-link text-dark fw-bold" href="#">
        <i class="bi bi-house-door"></i> Home
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark fw-bold" href="#">
        <i class="bi bi-info-circle"></i> About
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark fw-bold" href="#">
        <i class="bi bi-gear"></i> Services
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark fw-bold" href="#">
        <i class="bi bi-envelope"></i> Contact
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark fw-bold" href="/login">
        <i class="bi bi-person-circle"></i> 
      </a>
    </li>
  </ul>
</nav>

    <section id="buscar" class="py-5">
        <div class="container">

            {{-- Formulario de búsqueda --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h2 class="h5 text-dark mb-3">Consulta(Confirmacion)</h2>
                    <form method="GET" action="{{ route('welcome') }}">
                        <div class="input-group">
                            <input type="text" name="dni" class="form-control" placeholder="Ingrese DNI" required>
                            <button class="btn btn-dark" type="submit">Buscar</button>
                        </div>
                    </form>
                    @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first('dni') }}
                    </div>
                    @endif
                </div>
            </div>

            {{-- Modal de resultado --}}
            @if($confirmando)
            <div class="modal fade show" id="resultadoModal" tabindex="-1" aria-labelledby="resultadoModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-light text-dark shadow-lg">
                        <div class="modal-header">
                            <h5 class="modal-title" id="resultadoModalLabel">
                                <i class="bi bi-person-circle text-danger me-2"></i>
                                {{ $confirmando->nombre }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">

                            {{-- Información personal --}}
                            <h6 class="text-danger">Información personal</h6>
                            <ul class="list-unstyled mb-3">
                                <li><strong>DNI:</strong> {{ $confirmando->dni }}</li>
                                <li><strong>Colegio:</strong> {{ $confirmando->colegio ?? 'N/A' }}</li>
                                <li><strong>Capilla cercana:</strong> {{ $confirmando->capilla_cercana ?? 'N/A' }}</li>
                                <li><strong>Dirección:</strong> {{ $confirmando->direccion ?? 'N/A' }}</li>
                                <li><strong>Observaciones:</strong> {{ $confirmando->observaciones ?? 'N/A' }}</li>
                                <li><strong>Comunidad:</strong> {{ $confirmando->comunidad?->nombre ?? 'Sin comunidad asignada' }}</li>
                            </ul>

                            {{-- Asistencias --}}
                            <h6 class="text-danger">Asistencias</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Tema</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($confirmando->asistencias as $asistencia)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($asistencia->jornada->fecha)->format('d/m/Y') }}</td>
                                            <td>{{ $asistencia->jornada->tema }}</td>
                                            <td>
                                                @switch($asistencia->estado)
                                                @case('asistio')
                                                <span class="badge bg-success">Asistió</span>
                                                @break
                                                @case('tardanza')
                                                <span class="badge bg-warning text-dark">Tardanza</span>
                                                @break
                                                @case('falta_justificada')
                                                <span class="badge bg-info">Falta Justificada</span>
                                                @break
                                                @case('falta_sin_justificar')
                                                <span class="badge bg-danger">Falta Sin Justificar</span>
                                                @break
                                                @default
                                                <span class="badge bg-secondary">Sin registro</span>
                                                @endswitch
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No hay registros de asistencia.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Script para abrir el modal automáticamente --}}
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var modal = new bootstrap.Modal(document.getElementById('resultadoModal'));
                    modal.show();
                });
            </script>
            @endif

        </div>
    </section>

</body>
</html>




    <!-- Footer-->
<footer class="bg-blue text-white py-3 fixed-bottom">
  <div class="container text-center">
    <small>&copy; 2023 - Company Name</small>
  </div>
</footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>