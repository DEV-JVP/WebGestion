<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

  <title>Document</title>
</head>

<style>
  @import url("https://fonts.googleapis.com/css2?family=SUSE+Mono:ital,wght@0,100..800;1,100..800&display=swap");

  body {
    font-family: "SUSE Mono", sans-serif;
  }

  .gradient-custom-2 {
    background: linear-gradient(to right, #000000ff, #000000ff, #000000ff, #000000ff);
  }

  @media (min-width: 768px) {
    .gradient-form {
      height: 100vh !important;
    }
  }

  @media (min-width: 769px) {
    .gradient-custom-2 {
      border-top-right-radius: .3rem;
      border-bottom-right-radius: .3rem;
    }
  }

  .right-panel-img {
    width: 100%;
    max-width: 380px;
    border-radius: 0.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
  }
</style>

<body>
  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">

              <!-- LADO IZQUIERDO -->
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">
                  <div class="text-center">
                    <img src="https://img.freepik.com/vector-premium/religion-cristiana-simbolo-cruz-negra-fondo-blanco-ilustracion-vectorial_34480-1211.jpg?semt=ais_hybrid&w=740&q=80"
                      style="width: 120px;" alt="cruz">
                    <h4 class="mt-1 mb-5 pb-1">ISCJ</h4>
                  </div>

                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <p>Por favor, inicie sesión en su cuenta</p>

                    {{-- MENSAJE DE ERROR GLOBAL (ejemplo: credenciales incorrectas) --}}
                    @if ($errors->has('email'))
                    <div class="alert alert-danger">
                      {{ $errors->first('email') }}
                    </div>
                    @endif

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example11">
                        <i class="bx bx-user"></i> Usuario
                      </label>
                      <input type="email" name="email" id="form2Example11"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus>

                      {{-- ERROR DE VALIDACIÓN PARA EL CAMPO EMAIL --}}
                      @error('email')
                      <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example22">
                        <i class="bx bx-lock"></i> Contraseña
                      </label>
                      <input type="password" name="password" id="form2Example22"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="********" required>

                      {{-- ERROR DE VALIDACIÓN PARA EL CAMPO PASSWORD --}}
                      @error('password')
                      <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                      <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">
                        <i class="bx bx-log-in-circle"></i> Ingresar
                      </button>
                    </div>
                    <div class="text-center">
    <a href="{{ url('/') }}" class="btn btn-outline-secondary">
        <i class="bx bx-home"></i> Volver al inicio
    </a>
</div>

                  </form>

                </div>
              </div>

              <!-- LADO DERECHO -->
              <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center gradient-custom-2 text-center p-4">
                <img src="https://i.pinimg.com/736x/ad/4a/4b/ad4a4bf27e8fb9cf667341575de1d4d3.jpg"
                  alt="Jóvenes reunidos"
                  class="right-panel-img mb-4">

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>