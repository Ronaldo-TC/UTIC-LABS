<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistema de Activos Fijos') - Gestión de Activos</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --sidebar-width: 250px;
            --header-height: 60px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #333;
        }

        /* Layout Principal */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, #1a252f 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-header .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .logo-icon {
            background: var(--secondary-color);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-section {
            margin-bottom: 25px;
        }

        .nav-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.6);
            padding: 0 20px;
            margin-bottom: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: var(--secondary-color);
        }

        .nav-link.active {
            background: rgba(52, 152, 219, 0.2);
            color: white;
            border-left-color: var(--secondary-color);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }

        /* Header */
        .main-header {
            background: white;
            height: var(--header-height);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 999;
            padding: 0 25px;
        }

        .header-content {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: var(--primary-color);
            font-size: 1.2rem;
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: var(--light-color);
        }

        .page-title h1 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
        }

        .page-title small {
            color: #6c757d;
            font-size: 0.85rem;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--secondary-color), #8e44ad);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        /* Content Area */
        .content-wrapper {
            padding: 25px;
            min-height: calc(100vh - var(--header-height));
        }

        /* Breadcrumb */
        .breadcrumb-custom {
            background: white;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Card Styling */
        .card-custom {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .card-header-custom {
            background: linear-gradient(45deg, var(--secondary-color), #2980b9);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
            border: none;
        }

        /* Alert Styling */
        .alert-custom {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Buttons */
        .btn-custom {
            border-radius: 6px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--secondary-color), #2980b9);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #2980b9, var(--secondary-color));
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        /* Stats Cards */
        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .stats-icon.primary {
            background: rgba(52, 152, 219, 0.1);
            color: var(--secondary-color);
        }

        .stats-icon.success {
            background: rgba(39, 174, 96, 0.1);
            color: var(--success-color);
        }

        .stats-icon.warning {
            background: rgba(243, 156, 18, 0.1);
            color: var(--warning-color);
        }

        .stats-icon.danger {
            background: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
        }

        /* Footer */
        .main-footer {
            background: white;
            padding: 20px;
            margin-top: auto;
            border-top: 1px solid #e9ecef;
            text-align: center;
            color: #6c757d;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
            }

            .overlay.active {
                display: block;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Loading Spinner */
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--secondary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Estilos para las badges de estado */
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Estilos para los filtros */
        .form-control-modern:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
        }

        /* Paginación personalizada */
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #4361ee, #3f37c9);
            border-color: #4361ee;
            color: white;
        }

        .pagination .page-link {
            color: #4361ee;
            border-radius: 8px;
            margin: 0 4px;
        }

        .pagination .page-link:hover {
            background: rgba(67, 97, 238, 0.1);
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- App Container -->
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('home') }}" class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div>
                        <span>Activos</span>
                        <small style="display: block; font-size: 0.8rem; opacity: 0.8;">Sistema de Gestión</small>
                    </div>
                </a>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-title">Principal</div>
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-title">Gestión</div>
                    <a href="{{ route('activos.index') }}" class="nav-link {{ request()->routeIs('activos*') ? 'active' : '' }}">
                        <i class="fas fa-laptop"></i>
                        <span>Activos</span>
                        @php
                        $activos_count = \App\Models\Activo::count();
                        @endphp
                        @if($activos_count > 0)
                        <span class="badge bg-primary ms-auto">{{ $activos_count }}</span>
                        @endif
                    </a>

                    <a href="{{ route('responsables.index') }}" class="nav-link {{ request()->routeIs('responsables*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Responsables</span>
                    </a>

                    <a href="{{ route('grupos.index') }}" class="nav-link {{ request()->routeIs('grupos*') ? 'active' : '' }}">
                        <i class="fas fa-layer-group"></i>
                        <span>Grupos</span>
                    </a>

                    <a href="{{ route('oficinas.index') }}" class="nav-link {{ request()->routeIs('oficinas*') ? 'active' : '' }}">
                        <i class="fas fa-building"></i>
                        <span>Oficinas</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-title">Reportes</div>
                    <a href="{{ route('reportes.activos-pdf') }}" class="nav-link" target="_blank">
                        <i class="fas fa-file-pdf"></i>
                        <span>Reporte PDF</span>
                    </a>

                    <a href="{{ route('reportes.activos-qr') }}" class="nav-link">
                        <i class="fas fa-qrcode"></i>
                        <span>Códigos QR</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-title">Sistema</div>
                    <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#helpModal">
                        <i class="fas fa-question-circle"></i>
                        <span>Ayuda</span>
                    </a>

                    <!-- Botón de Cerrar Sesión SIMPLIFICADO -->
                    <a href="#" class="nav-link" onclick="showLogoutConfirmation()">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar Sesión</span>
                    </a>
                </div>
            </nav>

            <!-- Sidebar Footer -->
            <div class="sidebar-footer" style="padding: 20px; text-align: center; border-top: 1px solid rgba(255,255,255,0.1); margin-top: auto;">
                <small style="opacity: 0.7;">Versión 1.0.0</small><br>
                <small style="opacity: 0.5;">© {{ date('Y') }} Sistema Activos</small>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div class="overlay" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="main-header">
                <div class="header-content">
                    <div class="header-left">
                        <button class="sidebar-toggle" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="page-title">
                            <h1>
                                <i class="@yield('icon', 'fas fa-cog') me-2"></i>
                                @yield('title', 'Dashboard')
                            </h1>
                            @hasSection('subtitle')
                            <small>@yield('subtitle')</small>
                            @endif
                        </div>
                    </div>

                    <div class="header-right">
                        <div class="user-profile">
                            <div class="user-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="user-info">
                                <strong>Administrador</strong><br>
                                <small>Sistema de Activos</small>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Wrapper -->
            <div class="content-wrapper">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="breadcrumb-custom fade-in">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Inicio</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>

                <!-- Page Actions -->
                @hasSection('actions')
                <div class="d-flex justify-content-between align-items-center mb-4 fade-in">
                    <div>
                        <h3 class="mb-0">
                            <i class="@yield('icon', 'fas fa-cog') me-2 text-primary"></i>
                            @yield('title')
                        </h3>
                        @hasSection('subtitle')
                        <p class="text-muted mb-0">@yield('subtitle')</p>
                        @endif
                    </div>
                    <div class="actions">
                        @yield('actions')
                    </div>
                </div>
                @endif

                <!-- Messages -->
                @if(session('success'))
                <div class="alert alert-success alert-custom alert-dismissible fade show fade-in" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle fa-2x me-3"></i>
                        <div>
                            <h5 class="mb-1">¡Éxito!</h5>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-custom alert-dismissible fade show fade-in" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle fa-2x me-3"></i>
                        <div>
                            <h5 class="mb-1">¡Error!</h5>
                            <p class="mb-0">{{ session('error') }}</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('warning'))
                <div class="alert alert-warning alert-custom alert-dismissible fade show fade-in" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                        <div>
                            <h5 class="mb-1">¡Advertencia!</h5>
                            <p class="mb-0">{{ session('warning') }}</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger alert-custom alert-dismissible fade show fade-in" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-times-circle fa-2x me-3"></i>
                        <div>
                            <h5 class="mb-1">¡Errores encontrados!</h5>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <!-- Main Content -->
                <div class="fade-in">
                    @yield('content')
                </div>
            </div>

            <!-- Footer -->
            <footer class="main-footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Sistema de Gestión de Activos Fijos</strong>
                            <p class="mb-0"><small>© {{ date('Y') }} - Todos los derechos reservados</small></p>
                        </div>
                        <div class="col-md-6 text-end">
                            <small>
                                <i class="fas fa-clock me-1"></i>
                                {{ now()->format('d/m/Y H:i:s') }}
                                <span class="mx-2">|</span>
                                <i class="fas fa-database me-1"></i>
                                {{ \App\Models\Activo::count() }} activos
                            </small>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Help Modal -->
    <div class="modal fade" id="helpModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header card-header-custom">
                    <h5 class="modal-title">
                        <i class="fas fa-question-circle me-2"></i>
                        Ayuda del Sistema
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6>Bienvenido al Sistema de Activos Fijos</h6>
                    <p>Este sistema le permite gestionar todos los activos fijos de su organización.</p>

                    <h6 class="mt-3">Funcionalidades principales:</h6>
                    <ul>
                        <li><strong>Activos:</strong> Registrar, editar y eliminar activos fijos</li>
                        <li><strong>Responsables:</strong> Gestionar personas responsables</li>
                        <li><strong>Grupos:</strong> Clasificar activos por categorías</li>
                        <li><strong>Oficinas:</strong> Administrar ubicaciones físicas</li>
                        <li><strong>Reportes:</strong> Generar PDF y códigos QR</li>
                    </ul>

                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Para soporte técnico, contacte al administrador del sistema.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts personalizados -->
    <script>
        // Sidebar toggle for mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    sidebarOverlay.classList.toggle('active');
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                });
            }

            // Auto-hide sidebar on mobile when clicking a link
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992) {
                        sidebar.classList.remove('active');
                        sidebarOverlay.classList.remove('active');
                    }
                });
            });

            // Set active nav link based on current URL
            const currentPath = window.location.pathname;
            navLinks.forEach(link => {
                const linkPath = link.getAttribute('href');
                if (linkPath && currentPath.startsWith(linkPath) && linkPath !== '/') {
                    link.classList.add('active');
                }
            });

            // Auto-dismiss alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });

            // Confirmation for delete actions
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('¿Está seguro de eliminar este registro? Esta acción no se puede deshacer.')) {
                        e.preventDefault();
                    }
                });
            });
        });

        // Función para mostrar confirmación de logout
        function showLogoutConfirmation() {
            Swal.fire({
                title: '¿Cerrar sesión?',
                text: '¿Está seguro de que desea salir del sistema?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, salir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // En un sistema real, aquí harías una petición al servidor
                    // Por ahora, solo mostramos un mensaje
                    Swal.fire({
                        title: '¡Sesión cerrada!',
                        text: 'Ha salido del sistema correctamente.',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // Recargar la página para simular logout
                        window.location.reload();
                    });
                }
            });
        }

        // Global function for SweetAlert confirmations
        function confirmAction(message, callback) {
            Swal.fire({
                title: '¿Está seguro?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed && typeof callback === 'function') {
                    callback();
                }
            });
        }

        // Function to copy to clipboard
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Copiado',
                    text: 'Texto copiado al portapapeles',
                    timer: 1500,
                    showConfirmButton: false
                });
            });
        }

        // Update current time in footer every minute
        function updateCurrentTime() {
            const now = new Date();
            const options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            const formatted = now.toLocaleDateString('es-ES', options) + ' ' +
                now.toLocaleTimeString('es-ES', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });

            const timeElements = document.querySelectorAll('.fa-clock');
            timeElements.forEach(el => {
                if (el.parentElement) {
                    el.parentElement.innerHTML = `<i class="fas fa-clock me-1"></i>${formatted}`;
                }
            });
        }

        // Update time every minute
        setInterval(updateCurrentTime, 60000);
    </script>

    @stack('scripts')
</body>

</html>