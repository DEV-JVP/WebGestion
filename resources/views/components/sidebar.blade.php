<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
      <script src="https://cdn.tailwindcss.com"></script>

  

  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />

  <!-- Boxicons -->
  <link
    href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet" />

  <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <aside id="sidebar">
      <div class="d-flex justify-content-between p-4">
        <div class="sidebar-logo">
          <a href="#">Principal</a>
        </div>

        <button class="toggle-btn border-0" type="button">
          <i id="icon" class="bx bxs-chevrons-right"></i>
        </button>
      </div>

      <ul class="sidebar-nav">
        <li class="sidebar-item">
          <a href="/confirmandos" class="sidebar-link">
            <i class="bx bx-user"></i>
            <span>Confirmandos</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a href="/comunidades" class="sidebar-link">
            <i class='bx bx-building-house'></i>
            <span>Comunidades</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a href="/guias" class="sidebar-link">
            <i class='bx bx-group'></i>
            <span>Equipo</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a href="/jornadas" class="sidebar-link">
            <i class='bx bx-check-square'></i>
            <span>Asistencias</span>
          </a>
        </li>

        <li class="sidebar-item">
          <a href="/documentos" class="sidebar-link">
            <i class='bx bxs-book'></i>
            <span>Documentos</span>
          </a>
        </li>


        <li class="sidebar-item">
          <a
            href="#"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#auth"
            aria-expanded="false"
            aria-controls="auth">
            <i class="bx bx-bug"></i>
            <span>Auth</span>
          </a>

          <ul
            id="auth"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar">
            <li class="sidebar-item">
              <a href="#" class="sidebar-link">Login</a>
            </li>

            <li class="sidebar-item">
              <a href="#" class="sidebar-link">Register</a>
            </li>
          </ul>
        </li>


      </ul>
      <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="sidebar-link d-flex align-items-center border-0 bg-transparent w-100">
            <i class='bx bx-log-out-circle'></i>

          </button>
        </form>
      </div>


    </aside>
    <div class="main p-4">
      {{ $slot }}
    </div>

    <!-- Bootstrap JS (necesario para collapse) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>
</body>

</html>