<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Argon Dashboard Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Agregando Playfair Display para headings y Source Sans Pro para body -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Source+Sans+Pro:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Agregando Chart.js para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            /* Aplicando tokens de diseño del brief */
            --background: #ffffff;
            --foreground: #1f2937;
            --card: #f1f5f9;
            --card-foreground: #1f2937;
            --primary: #1f2937;
            --primary-foreground: #ffffff;
            --secondary: #6366f1;
            --secondary-foreground: #ffffff;
            --muted: #f1f5f9;
            --muted-foreground: #1f2937;
            --accent: #6366f1;
            --accent-foreground: #ffffff;
            --border: #e5e7eb;
            --sidebar: #f1f5f9;
            --sidebar-foreground: #1f2937;
            --sidebar-primary: #6366f1;
            --chart-1: #6366f1;
            --chart-2: #d97706;
            --chart-3: #1f2937;
            --chart-4: #374151;
            --chart-5: #8b5cf6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            /* Aplicando tipografía del brief */
            font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, sans-serif;
            font-weight: 400;
            background-color: var(--background);
            color: var(--foreground);
        }

        /* Estilos para headings con Playfair Display */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: var(--sidebar);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            z-index: 1000;
            border-right: 1px solid var(--border);
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid var(--border);
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
            background: linear-gradient(135deg, var(--secondary), #1d4ed8);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            font-weight: 600;
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
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
            background: white;
            border: 1px solid var(--border);
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
            background: var(--muted);
            color: var(--secondary);
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
            font-weight: 400;
            font-size: 0.875rem;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover {
            background: rgba(99, 102, 241, 0.08);
            color: var(--secondary);
            transform: translateX(2px);
        }

        .nav-link.active {
            background: rgba(99, 102, 241, 0.1);
            color: var(--secondary);
            font-weight: 500;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--secondary);
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
            background: var(--secondary);
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

        /* Estilos para el dashboard principal */
        .main-content {
            margin-left: 280px;
            padding: 0;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            background: var(--background);
        }

        .sidebar.collapsed + .main-content {
            margin-left: 70px;
        }

        /* Header del dashboard */
        .dashboard-header {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--primary);
            margin: 0;
        }

        .header-subtitle {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0;
            margin-top: 0.25rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-left: auto;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--secondary), #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-info h6 {
            margin: 0;
            font-size: 0.875rem;
            color: var(--primary);
        }

        .user-info p {
            margin: 0;
            font-size: 0.75rem;
            color: #64748b;
        }

        /* Dashboard content */
        .dashboard-content {
            padding: 2rem;
        }

        /* Cards de métricas */
        .metric-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            height: 100%;
        }

        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .metric-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .metric-icon.primary {
            background: rgba(99, 102, 241, 0.1);
            color: var(--secondary);
        }

        .metric-icon.success {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .metric-icon.warning {
            background: rgba(217, 119, 6, 0.1);
            color: #d97706;
        }

        .metric-icon.info {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .metric-value {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin: 0;
        }

        .metric-label {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0;
            margin-top: 0.25rem;
        }

        .metric-change {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-top: 0.5rem;
            font-size: 0.75rem;
        }

        .metric-change.positive {
            color: #22c55e;
        }

        .metric-change.negative {
            color: #ef4444;
        }

        /* Chart containers */
        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            height: 400px;
        }

        .chart-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
            margin: 0 0 1rem 0;
        }

        /* Tabla de datos */
        .data-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
        }

        .table-header {
            background: var(--muted);
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .table-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary);
            margin: 0;
        }

        .table {
            margin: 0;
        }

        .table th {
            background: var(--muted);
            color: var(--primary);
            font-weight: 600;
            border: none;
            padding: 1rem 1.5rem;
        }

        .table td {
            padding: 1rem 1.5rem;
            border-color: var(--border);
            color: var(--foreground);
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-badge.active {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .status-badge.pending {
            background: rgba(217, 119, 6, 0.1);
            color: #d97706;
        }

        .status-badge.inactive {
            background: rgba(107, 114, 128, 0.1);
            color: #6b7280;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .sidebar.collapsed {
                width: 280px;
                transform: translateX(-100%);
            }
            
            .sidebar.collapsed.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .dashboard-header {
                padding: 1rem;
            }
            
            .dashboard-content {
                padding: 1rem;
            }
            
            .mobile-toggle {
                display: block;
                position: fixed;
                top: 1rem;
                left: 1rem;
                z-index: 1001;
                background: white;
                border: 1px solid var(--border);
                border-radius: 8px;
                padding: 0.5rem;
                cursor: pointer;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }
            
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

            .header-title {
                font-size: 1.5rem;
            }

            .user-profile {
                display: none;
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

        /* Scrollbar personalizado */
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
    </style>
</head>
<body>
   <x-sidebar> <button class="mobile-toggle" onclick="toggleMobileSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeMobileSidebar()"></div>

    <div class="main-content">
        <!-- Header del dashboard -->
        <div class="dashboard-header">
            <div>
                <h1 class="header-title">Dashboard</h1>
                <p class="header-subtitle">Bienvenido de vuelta, aquí tienes un resumen de tu negocio</p>
            </div>
            <div class="user-profile">
                <div class="user-avatar">
                    JD
                </div>
                <div class="user-info">
                    <h6>Juan Pérez</h6>
                    <p>Administrador</p>
                </div>
            </div>
        </div>

        <!-- Contenido del dashboard -->
        <div class="dashboard-content">
            <!-- Métricas principales -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="metric-card">
                        <div class="metric-icon primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="metric-value">2,847</h3>
                        <p class="metric-label">Usuarios Totales</p>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12.5% vs mes anterior</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="metric-card">
                        <div class="metric-icon success">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <h3 class="metric-value">$24,580</h3>
                        <p class="metric-label">Ingresos del Mes</p>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+8.2% vs mes anterior</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="metric-card">
                        <div class="metric-icon warning">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3 class="metric-value">1,247</h3>
                        <p class="metric-label">Pedidos</p>
                        <div class="metric-change negative">
                            <i class="fas fa-arrow-down"></i>
                            <span>-3.1% vs mes anterior</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="metric-card">
                        <div class="metric-icon info">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="metric-value">94.2%</h3>
                        <p class="metric-label">Tasa de Conversión</p>
                        <div class="metric-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+2.4% vs mes anterior</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="row mb-4">
                <div class="col-lg-8 mb-4">
                    <div class="chart-card">
                        <h3 class="chart-title">Ingresos Mensuales</h3>
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="chart-card">
                        <h3 class="chart-title">Distribución de Usuarios</h3>
                        <canvas id="usersChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Tabla de datos -->
            <div class="row">
                <div class="col-12">
                    <div class="data-table">
                        <div class="table-header">
                            <h3 class="table-title">Usuarios Recientes</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Fecha de Registro</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-3" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                                    AM
                                                </div>
                                                <strong>Ana Martínez</strong>
                                            </div>
                                        </td>
                                        <td>ana.martinez@email.com</td>
                                        <td>15 Dic 2024</td>
                                        <td><span class="status-badge active">Activo</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-3" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                                    CL
                                                </div>
                                                <strong>Carlos López</strong>
                                            </div>
                                        </td>
                                        <td>carlos.lopez@email.com</td>
                                        <td>14 Dic 2024</td>
                                        <td><span class="status-badge pending">Pendiente</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-3" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                                    MR
                                                </div>
                                                <strong>María Rodríguez</strong>
                                            </div>
                                        </td>
                                        <td>maria.rodriguez@email.com</td>
                                        <td>13 Dic 2024</td>
                                        <td><span class="status-badge active">Activo</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-3" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                                    JG
                                                </div>
                                                <strong>José García</strong>
                                            </div>
                                        </td>
                                        <td>jose.garcia@email.com</td>
                                        <td>12 Dic 2024</td>
                                        <td><span class="status-badge inactive">Inactivo</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> </x-sidebar>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const toggleIcon = document.getElementById('toggleIcon');
            
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
            
            if (window.innerWidth <= 768) {
                closeMobileSidebar();
            }
        }

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

        document.addEventListener('DOMContentLoaded', function() {
            // Gráfico de ingresos
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    datasets: [{
                        label: 'Ingresos',
                        data: [12000, 19000, 15000, 25000, 22000, 30000, 28000, 35000, 32000, 38000, 42000, 45000],
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#e5e7eb'
                            },
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Gráfico de usuarios
            const usersCtx = document.getElementById('usersChart').getContext('2d');
            new Chart(usersCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Nuevos', 'Recurrentes', 'Inactivos'],
                    datasets: [{
                        data: [45, 35, 20],
                        backgroundColor: ['#6366f1', '#22c55e', '#d97706'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
