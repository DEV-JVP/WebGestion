<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Argon Sidebar Lite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <CHANGE> Cambiando a Inter font para un look más moderno y lite -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            /* <CHANGE> Tipografía más ligera con Inter */
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            font-weight: 400;
            background-color: #f8fafc;
            color: #64748b;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            /* <CHANGE> Fondo más lite, menos saturado */
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            /* <CHANGE> Sombra más sutil para look lite */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            z-index: 1000;
            /* <CHANGE> Borde sutil en lugar de sombra fuerte */
            border-right: 1px solid #e2e8f0;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 1.5rem 1.25rem;
            /* <CHANGE> Borde más sutil */
            border-bottom: 1px solid #e2e8f0;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            /* <CHANGE> Colores más suaves para el logo */
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            font-weight: 600;
        }

        .logo-text {
            /* <CHANGE> Texto más ligero */
            font-size: 1.25rem;
            font-weight: 500;
            color: #1e293b;
            white-space: nowrap;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
        }

        .toggle-btn {
            position: absolute;
            top: 1.5rem;
            right: -12px;
            width: 24px;
            height: 24px;
            /* <CHANGE> Botón más sutil */
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #64748b;
            font-size: 0.75rem;
        }

        .toggle-btn:hover {
            /* <CHANGE> Hover más sutil */
            background: #f1f5f9;
            color: #3b82f6;
            transform: scale(1.1);
        }

        .sidebar-nav {
            padding: 1rem 0;
            height: calc(100vh - 80px);
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 1.5rem;
        }

        .nav-section-title {
            /* <CHANGE> Títulos más ligeros */
            font-size: 0.75rem;
            font-weight: 500;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0 1.25rem;
            margin-bottom: 0.5rem;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-section-title {
            opacity: 0;
        }

        .nav-item {
            margin: 0.25rem 0.75rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #64748b;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            /* <CHANGE> Peso de fuente más ligero */
            font-weight: 400;
            font-size: 0.875rem;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            /* <CHANGE> Hover más sutil y lite */
            background: rgba(59, 130, 246, 0.08);
            color: #3b82f6;
            transform: translateX(2px);
        }

        .nav-link.active {
            /* <CHANGE> Estado activo más sutil */
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            font-weight: 500;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #3b82f6;
        }

        .nav-icon {
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        .nav-text {
            white-space: nowrap;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
        }

        .nav-badge {
            /* <CHANGE> Badges más sutiles */
            background: #3b82f6;
            color: white;
            font-size: 0.625rem;
            font-weight: 500;
            padding: 0.125rem 0.375rem;
            border-radius: 10px;
            margin-left: auto;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-badge {
            opacity: 0;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }

        .sidebar.collapsed + .main-content {
            margin-left: 70px;
        }

        /* <CHANGE> Scrollbar más sutil para el look lite */
        .sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 2px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px; /* Mantener ancho completo en móvil */
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .sidebar.collapsed {
                width: 280px; /* En móvil no colapsar, solo ocultar/mostrar */
                transform: translateX(-100%);
            }
            
            .sidebar.collapsed.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 1rem; /* Menos padding en móvil */
            }
            
            /* <CHANGE> Botón hamburguesa para móviles */
            .mobile-toggle {
                display: block;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1001;
                background: white;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                padding: 0.5rem;
                cursor: pointer;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }
            
            /* <CHANGE> Overlay para cerrar sidebar en móvil */
            .sidebar-overlay {
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }
            
            .sidebar-overlay.show {
                opacity: 1;
                visibility: visible;
            }
        }
        
        @media (min-width: 769px) {
            .mobile-toggle {
                display: none;
            }
            
            .sidebar-overlay {
                display: none;
            }
        }

        /* <CHANGE> Animaciones más suaves para el estilo lite */
        .nav-link {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-cube"></i>
                </div>
                <span class="logo-text">Argon Lite</span>
            </a>
            <div class="toggle-btn" onclick="toggleSidebar()">
                <i class="fas fa-chevron-left" id="toggleIcon"></i>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Principal</div>
                <div class="nav-item">
                    <a href="/dashboard" class="nav-link active" onclick="setActive(this)">
                        <span class="nav-icon"><i class="fas fa-home"></i></span>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/confirmandos" class="nav-link" onclick="setActive(this)">
                        <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>
                        <span class="nav-text">Confirmandos</span>
                        
                    </a>
                </div>
                <div class="nav-item">
                    <a href="/comunidades" class="nav-link" onclick="setActive(this)">
                        <span class="nav-icon"><i class="fas fa-users"></i></span>
                        <span class="nav-text">Comunidades</span>
                    </a>
                </div>
                  <div class="nav-item">
                    <a href="/jornadas" class="nav-link" onclick="setActive(this)">
                        <span class="nav-icon"><i class="fas fa-users"></i></span>
                        <span class="nav-text">Asistencias</span>
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Gestión</div>
                <div class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <span class="nav-icon"><i class="fas fa-box"></i></span>
                        <span class="nav-text">Productos</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <span class="nav-icon"><i class="fas fa-shopping-cart"></i></span>
                        <span class="nav-text">Pedidos</span>
                        <span class="nav-badge">8</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <span class="nav-icon"><i class="fas fa-credit-card"></i></span>
                        <span class="nav-text">Facturación</span>
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Configuración</div>
                <div class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <span class="nav-icon"><i class="fas fa-cog"></i></span>
                        <span class="nav-text">Ajustes</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <span class="nav-icon"><i class="fas fa-user-circle"></i></span>
                        <span class="nav-text">Perfil</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" onclick="setActive(this)">
                        <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                        <span class="nav-text">Cerrar Sesión</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- <CHANGE> Agregando botón móvil y overlay -->
    <button class="mobile-toggle" onclick="toggleMobileSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeMobileSidebar()"></div>

 <main class="col p-4 ms-lg-5 text-muted min-vh-100">
    {{ $slot }}
</main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const toggleIcon = document.getElementById('toggleIcon');
            
            // <CHANGE> Solo funciona en desktop
            if (window.innerWidth > 768) {
                sidebar.classList.toggle('collapsed');
                
                if (sidebar.classList.contains('collapsed')) {
                    toggleIcon.classList.remove('fa-chevron-left');
                    toggleIcon.classList.add('fa-chevron-right');
                } else {
                    toggleIcon.classList.remove('fa-chevron-right');
                    toggleIcon.classList.add('fa-chevron-left');
                }
            }
        }

        // <CHANGE> Funciones para móvil
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }
        
        function closeMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        }

        function setActive(element) {
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            
            element.classList.add('active');
            
            // <CHANGE> Cerrar sidebar en móvil al seleccionar
            if (window.innerWidth <= 768) {
                closeMobileSidebar();
            }
        }

        // <CHANGE> Manejo responsive mejorado
        function handleResize() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('collapsed');
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            } else {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize();
    </script>
</body>
</html>