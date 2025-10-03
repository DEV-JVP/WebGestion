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


<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');


a {
  text-decoration: none;
}

li {
  list-style: none;
}

body {
   font-family: "Roboto", sans-Light 300;
 

}

.wrapper {
  display: flex;
}

.main {
  min-height: 100vh;
  width: 100%;
  overflow: hidden;
  background-color: #f5f5f5;
}

#sidebar {
  width: 90px;
  min-width: 90px;
  transition: all 0.25s ease-in-out;
  background-color: black;
  display: flex;
  flex-direction: column;
}

#sidebar:not(.expand) .sidebar-logo,
#sidebar:not(.expand) a.sidebar-link span {
  display: none;
}

#sidebar.expand {
  width: 260px;
  min-width: 260px;
}

.toggle-btn {
  width: 30px;
  height: 30px;
  color: beige;
  border-radius: 0.425rem;
  font-size: 18px;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #323c55;
}

.toggle-btn i {
  color: aliceblue;
}

#sidebar.expand .sidebar-logo,
#sidebar.expand a.sidebar-link span {
  animation: fadeIn .25s ease;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.sidebar-logo a {
  color: white;
  font-size: 1.15rem;
  font-weight: 600;
}

a.sidebar-link {
  padding: .625rem 1.625rem;
  color: #fff;
  display: block;
  white-space: nowrap;
  font-weight: 700;
  border-left: 3px solid transparent;
  position: relative;
}

.sidebar-nav {
  padding: 0.7rem 0;
  flex: 11 auto;
  z-index: 10;
}

.sidebar-link i,
.dropdown-item i {
  font-size: 1.1rem;
  margin-right: .75rem;
}

a.sidebar-link:hover {
  background-color: rgba(255, 255, 255, .075);
  border-left: 3px solid #3b7ddd;
}

.sidebar-item {
  position: relative;
}

/* Dropdown en modo sidebar colapsado */
#sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
  position: absolute;
  top: 0;
  left: 90px;
  background-color: #0e2238;
  padding: 0;
  min-width: 15em;
  display: none;
}

#sidebar:not(.expand) .sidebar-item:hover .has-dropdown + .sidebar-dropdown {
  display: block;
  max-height: 15em;
  width: 100%;
  opacity: 1;
}

/* Flechas en expandido */
#sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
  border: solid;
  border-width: 0.075rem 0.075rem 0 0;
  content: "";
  display: inline-block;
  padding: 2px;
  position: absolute;
  right: 1.5rem;
  top: 1.4rem;
  transform: rotate(-135deg);
  transition: all 0.2s ease-out;
}

#sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
  transform: rotate(45deg);
  transition: all 0.2s ease-out;
}

.sidebar-dropdown .sidebar-link {
  position: relative;
  padding-left: 3rem;
  transition: all 0.5s;
}

.sidebar-dropdown a.sidebar-link::before {
  content: "";
  height: 0.125rem;
  width: 0.375rem;
  background-color: #FFFFFF80;
  position: absolute;
  left: 1.8rem;
  top: 50%;
  transform: translateY(-50%);
  transition: all 0.5s;
}

.sidebar-dropdown a.sidebar-link:hover {
  background-color: transparent;
  border-left: 3px solid transparent;
  padding-left: 3.8rem;
  color: #7277f2;
}

/* Que el botón de logout tenga mismo estilo que los enlaces */
.sidebar-footer button.sidebar-link {
    text-align: left;
    padding: .625rem 1.625rem;
    color: #fff;
    font-weight: 700;
    border-left: 3px solid transparent;
    width: 100%;
    background: transparent;
    cursor: pointer;
}

/* Hover igual al <a> */
.sidebar-footer button.sidebar-link:hover {
    background-color: rgba(255, 255, 255, .075);
    border-left: 3px solid #3b7ddd;
    color: #fff;
}

</style>
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
 <script>

  const hamburger = document.querySelector(".toggle-btn");
const toggler = document.querySelector("#icon");

hamburger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
    toggler.classList.toggle("bxs-chevrons-right");
    toggler.classList.toggle("bxs-chevrons-left");
});

 </script>

</body>

</html>