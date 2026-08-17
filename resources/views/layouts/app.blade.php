<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema de Laboratorios - UTIC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @stack('styles')

    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #6c8cff;
            --primary-dark: #2a3f8a;
            --secondary: #7209b7;
            --success: #4cc9f0;
            --success-dark: #0ea5e9;
            --danger: #f72585;
            --danger-dark: #b5179e;
            --warning: #f8961e;
            --warning-dark: #e07c0c;
            --dark: #0f0e17;
            --dark-surface: #1a1a2e;
            --gray: #6c757d;
            --gray-light: #e9ecef;
            --light: #f8f9fa;
            --white: #ffffff;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 8px 40px rgba(0, 0, 0, 0.12);
            --shadow-xl: 0 12px 60px rgba(0, 0, 0, 0.16);
            --radius: 16px;
            --radius-sm: 10px;
            --radius-xs: 6px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0f2f8;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--dark);
        }

        /* ===== NAVBAR MEJORADA ===== */
        .navbar-custom {
            background: linear-gradient(135deg, #0f0e17 0%, #1a1a2e 50%, #2a1f4a 100%) !important;
            padding: 0.6rem 0;
            box-shadow: var(--shadow-lg);
            position: sticky;
            top: 0;
            z-index: 1050;
            border-bottom: 2px solid rgba(67, 97, 238, 0.3);
        }

        .navbar-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--danger), var(--warning), var(--success));
            background-size: 300% 100%;
            animation: gradientMove 4s ease infinite;
        }

        @keyframes gradientMove {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        .navbar-custom .navbar-brand {
            font-weight: 900;
            font-size: 1.5rem;
            color: white !important;
            letter-spacing: -0.5px;
            padding: 0.5rem 1.5rem;
            background: rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-sm);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .navbar-custom .navbar-brand::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            opacity: 0;
            transition: var(--transition);
        }

        .navbar-custom .navbar-brand:hover::after {
            opacity: 1;
        }

        .navbar-custom .navbar-brand:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px) scale(1.02);
            box-shadow: var(--shadow-md);
        }

        .navbar-custom .navbar-brand i {
            font-size: 1.8rem;
            margin-right: 12px;
            color: var(--primary-light);
            filter: drop-shadow(0 0 8px rgba(67, 97, 238, 0.3));
        }

        .navbar-custom .navbar-toggler {
            border: 2px solid rgba(255, 255, 255, 0.2);
            padding: 0.5rem;
            border-radius: var(--radius-xs);
        }

        .navbar-custom .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.75) !important;
            font-weight: 500;
            padding: 0.7rem 1.4rem !important;
            border-radius: var(--radius-sm);
            transition: var(--transition);
            margin: 0 0.2rem;
            position: relative;
            font-size: 0.95rem;
        }

        .navbar-custom .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: var(--transition);
            transform: translateX(-50%);
            border-radius: 4px;
        }

        .navbar-custom .nav-link:hover::before,
        .navbar-custom .nav-link.active::before {
            width: 60%;
        }

        .navbar-custom .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
        }

        .navbar-custom .nav-link.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.12);
        }

        .navbar-custom .nav-link i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .navbar-custom .nav-link .badge-nav {
            position: absolute;
            top: 2px;
            right: 4px;
            background: var(--danger);
            color: white;
            font-size: 0.55rem;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(247, 37, 133, 0.4);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        /* ===== CONTENIDO ===== */
        .main-container {
            flex: 1;
            padding: 2rem 0;
            animation: fadeIn 0.6s ease;
        }

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

        /* ===== ALERTAS MEJORADAS ===== */
        .alert-custom {
            border: none;
            border-radius: var(--radius);
            padding: 1.2rem 1.8rem;
            box-shadow: var(--shadow-md);
            animation: slideDown 0.5s ease;
            display: flex;
            align-items: center;
            gap: 16px;
            backdrop-filter: blur(10px);
            border-left: 5px solid;
        }

        .alert-custom i {
            font-size: 1.8rem;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #b7ebc5);
            color: #0b5e1b;
            border-left-color: #28a745;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border-left-color: #dc3545;
        }

        .alert-custom .btn-close {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        /* ===== TARJETAS MEJORADAS ===== */
        .card-modern {
            background: var(--white);
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            overflow: hidden;
            position: relative;
        }

        .card-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--success));
            opacity: 0;
            transition: var(--transition);
        }

        .card-modern:hover::before {
            opacity: 1;
        }

        .card-modern:hover {
            box-shadow: var(--shadow-xl);
            transform: translateY(-6px);
        }

        .card-modern .card-header {
            background: var(--white);
            border-bottom: 2px solid var(--gray-light);
            padding: 1.4rem 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .card-modern .card-header h5 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            margin: 0;
        }

        .card-modern .card-header small {
            color: var(--gray);
            font-weight: 400;
            font-size: 0.85rem;
        }

        .card-modern .card-body {
            padding: 1.8rem;
        }

        .card-modern .card-footer {
            background: rgba(248, 249, 250, 0.8);
            border-top: 1px solid var(--gray-light);
            padding: 1rem 1.8rem;
        }

        /* ===== TABLAS MEJORADAS ===== */
        .table-modern {
            border-radius: var(--radius-sm);
            overflow: hidden;
        }

        .table-modern thead {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .table-modern thead th {
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 1rem 1.2rem;
            border: none;
            white-space: nowrap;
        }

        .table-modern tbody tr {
            transition: var(--transition);
            cursor: default;
        }

        .table-modern tbody tr:hover {
            background: rgba(67, 97, 238, 0.04);
            transform: scale(1.002);
        }

        .table-modern tbody td {
            padding: 0.9rem 1.2rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--gray-light);
            font-size: 0.9rem;
        }

        .table-modern tbody tr:last-child td {
            border-bottom: none;
        }

        /* ===== BADGES MEJORADAS ===== */
        .badge-status {
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-activo {
            background: linear-gradient(135deg, #d4edda, #b7ebc5);
            color: #0b5e1b;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.2);
        }

        .badge-mantenimiento {
            background: linear-gradient(135deg, #fff3cd, #ffe69c);
            color: #7a6200;
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.2);
        }

        .badge-baja {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.2);
        }

        .badge-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .badge-info {
            background: linear-gradient(135deg, #4cc9f0, #0ea5e9);
            color: white;
        }

        .badge-warning {
            background: linear-gradient(135deg, #f8961e, #e07c0c);
            color: white;
        }

        .badge-danger {
            background: linear-gradient(135deg, #f72585, #b5179e);
            color: white;
        }

        .badge-success {
            background: linear-gradient(135deg, #4cc9f0, #0ea5e9);
            color: white;
        }

        /* ===== BOTONES MEJORADOS ===== */
        .btn-custom {
            border: none;
            border-radius: var(--radius-sm);
            padding: 0.7rem 1.8rem;
            font-weight: 600;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            position: relative;
            overflow: hidden;
        }

        .btn-custom::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            transition: width 0.6s, height 0.6s, top 0.6s, left 0.6s;
        }

        .btn-custom:hover::after {
            width: 300px;
            height: 300px;
            top: -100px;
            left: -100px;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .btn-custom:active {
            transform: translateY(0px);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        .btn-primary-custom:hover {
            color: white;
            box-shadow: 0 6px 25px rgba(67, 97, 238, 0.5);
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #4cc9f0, #0ea5e9);
            color: white;
            box-shadow: 0 4px 15px rgba(76, 201, 240, 0.3);
        }

        .btn-success-custom:hover {
            color: white;
            box-shadow: 0 6px 25px rgba(76, 201, 240, 0.5);
        }

        .btn-danger-custom {
            background: linear-gradient(135deg, #f72585, #b5179e);
            color: white;
            box-shadow: 0 4px 15px rgba(247, 37, 133, 0.3);
        }

        .btn-danger-custom:hover {
            color: white;
            box-shadow: 0 6px 25px rgba(247, 37, 133, 0.5);
        }

        .btn-warning-custom {
            background: linear-gradient(135deg, #f8961e, #e07c0c);
            color: white;
            box-shadow: 0 4px 15px rgba(248, 150, 30, 0.3);
        }

        .btn-warning-custom:hover {
            color: white;
            box-shadow: 0 6px 25px rgba(248, 150, 30, 0.5);
        }

        .btn-outline-custom {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
        }

        .btn-outline-custom:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        /* ===== FORMULARIOS MEJORADOS ===== */
        .form-control-modern {
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-sm);
            padding: 0.8rem 1.2rem;
            transition: var(--transition);
            font-size: 0.95rem;
            background: var(--white);
        }

        .form-control-modern:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.12);
            outline: none;
        }

        .form-control-modern::placeholder {
            color: #adb5bd;
        }

        .form-label-modern {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-label-modern .required {
            color: var(--danger);
            margin-left: 4px;
        }

        .form-select-modern {
            border: 2px solid var(--gray-light);
            border-radius: var(--radius-sm);
            padding: 0.8rem 1.2rem;
            transition: var(--transition);
            font-size: 0.95rem;
            background-color: var(--white);
            cursor: pointer;
        }

        .form-select-modern:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.12);
            outline: none;
        }

        /* ===== PAGINACIÓN MEJORADA ===== */
        .pagination-modern .page-item .page-link {
            border: none;
            border-radius: var(--radius-sm);
            margin: 0 4px;
            color: var(--dark);
            font-weight: 500;
            transition: var(--transition);
            padding: 0.6rem 1rem;
        }

        .pagination-modern .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        .pagination-modern .page-item .page-link:hover {
            background: rgba(67, 97, 238, 0.1);
            transform: translateY(-2px);
        }

        .pagination-modern .page-item.disabled .page-link {
            color: #adb5bd;
        }

        /* ===== FOOTER MEJORADO ===== */
        .footer-custom {
            background: linear-gradient(135deg, #0f0e17, #1a1a2e);
            color: rgba(255, 255, 255, 0.7);
            padding: 1.5rem 0;
            margin-top: 3rem;
            border-top: 2px solid rgba(67, 97, 238, 0.2);
            position: relative;
        }

        .footer-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--danger), var(--warning), var(--success));
            background-size: 300% 100%;
            animation: gradientMove 4s ease infinite;
        }

        .footer-custom p {
            margin: 0;
            font-size: 0.85rem;
        }

        .footer-custom i {
            color: var(--primary-light);
        }

        .footer-custom .badge {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            font-weight: 700;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .navbar-custom .nav-link {
                padding: 0.5rem 1rem !important;
            }
        }

        @media (max-width: 768px) {
            .navbar-custom .navbar-brand {
                font-size: 1.1rem;
                padding: 0.3rem 0.8rem;
            }

            .navbar-custom .navbar-brand i {
                font-size: 1.3rem;
                margin-right: 6px;
            }

            .navbar-custom .nav-link {
                padding: 0.4rem 0.8rem !important;
                margin: 0.1rem 0;
            }

            .main-container {
                padding: 1rem 0;
            }

            .card-modern .card-header {
                flex-direction: column;
                gap: 10px;
                align-items: stretch;
                padding: 1rem 1.2rem;
            }

            .card-modern .card-body {
                padding: 1.2rem;
            }

            .table-modern {
                font-size: 0.8rem;
            }

            .table-modern thead th,
            .table-modern tbody td {
                padding: 0.5rem 0.6rem;
            }

            .alert-custom {
                padding: 0.8rem 1.2rem;
                font-size: 0.9rem;
            }

            .btn-custom {
                padding: 0.5rem 1.2rem;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            .footer-custom .row>div {
                margin-bottom: 0.5rem;
            }

            .footer-custom .row>div:last-child {
                margin-bottom: 0;
            }
        }

        /* ===== UTILIDADES ===== */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .shadow-hover {
            transition: var(--transition);
        }

        .shadow-hover:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
        }

        .rounded-custom {
            border-radius: var(--radius);
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #4cc9f0, #0ea5e9);
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, #f72585, #b5179e);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #f8961e, #e07c0c);
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-light);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
        }

        /* ===== ANIMACIONES ===== */
        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s ease-in-out infinite;
        }
    </style>
</head>

<body>
    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-laptop"></i> UTIC Labs
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            <i class="bi bi-grid-1x2-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('laboratorios.*') ? 'active' : '' }}"
                            href="{{ route('laboratorios.index') }}">
                            <i class="bi bi-building"></i> Laboratorios
                            <span class="badge-nav">{{ \App\Models\Laboratorio::count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('computadoras.*') ? 'active' : '' }}"
                            href="{{ route('computadoras.index') }}">
                            <i class="bi bi-laptop"></i> Computadoras
                            <span class="badge-nav">{{ \App\Models\Computadora::count() }}</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="reportesDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-file-pdf"></i> Reportes
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2">
                            <li>
                                <a class="dropdown-item" href="{{ route('reportes.computadoras') }}" target="_blank">
                                    <i class="bi bi-laptop text-primary me-2"></i> Computadoras
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('reportes.laboratorios') }}" target="_blank">
                                    <i class="bi bi-building text-primary me-2"></i> Laboratorios
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('reportes.resumen') }}" target="_blank">
                                    <i class="bi bi-bar-chart-fill text-success me-2"></i> Resumen Ejecutivo
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== CONTENIDO ===== -->
    <div class="main-container">
        <div class="container">
            @if(session('success'))
            <div class="alert alert-custom alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-custom alert-danger">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 text-center text-md-start">
                    <p>
                        <i class="bi bi-laptop me-2"></i>
                        Sistema UTIC
                        <span class="badge bg-primary ms-2">v3.0</span>
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <p>
                        <i class="bi bi-calendar3 me-2"></i>
                        {{ date('Y') }} - Unidad de Tecnologías
                    </p>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <p>
                        <i class="bi bi-clock me-2"></i>
                        <span id="current-time">{{ date('H:i:s') }}</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ===== RELOJ EN TIEMPO REAL =====
        function updateTime() {
            const now = new Date();
            const time = now.toTimeString().split(' ')[0];
            document.getElementById('current-time').textContent = time;
        }
        setInterval(updateTime, 1000);

        // ===== AUTO-CERRAR ALERTAS =====
        document.querySelectorAll('.alert-custom').forEach(alert => {
            setTimeout(() => {
                const closeBtn = alert.querySelector('.btn-close');
                if (closeBtn) {
                    closeBtn.click();
                }
            }, 5000);
        });

        // ===== DETECTAR TEMA OSCURO (opcional) =====
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            // Aquí puedes agregar lógica para tema oscuro si lo deseas
        }

        // ===== EFECTO DE PARPADEO EN NAVBAR BADGE =====
        document.querySelectorAll('.badge-nav').forEach(badge => {
            if (parseInt(badge.textContent) === 0) {
                badge.style.display = 'none';
            }
        });
    </script>

    @stack('scripts')
</body>

</html>