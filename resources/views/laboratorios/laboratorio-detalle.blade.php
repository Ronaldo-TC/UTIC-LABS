<!-- resources/views/reportes/laboratorio-detalle.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reporte - {{ $laboratorio->nombre }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            background: #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #4361ee;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            color: #1a1a2e;
        }

        .header .subtitle {
            margin: 5px 0 0;
            color: #6c757d;
            font-size: 13px;
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #4361ee;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .info-box strong {
            color: #1a1a2e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background: #4361ee;
            color: white;
            padding: 10px 12px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 8px 12px;
            border-bottom: 1px solid #e9ecef;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-info {
            background: #cce5ff;
            color: #004085;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #95a5a6;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .summary {
            display: flex;
            justify-content: space-around;
            margin: 15px 0 20px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .summary-item {
            text-align: center;
        }

        .summary-item .number {
            font-size: 20px;
            font-weight: bold;
            color: #4361ee;
        }

        .summary-item .label {
            font-size: 11px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>🏢 {{ $laboratorio->nombre }}</h1>
        <p class="subtitle">Reporte detallado del laboratorio</p>
        <p class="subtitle">Fecha: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <div class="info-box">
        <strong>📍 Ubicación:</strong> {{ $laboratorio->ubicacion }}<br>
        <strong>📅 Fecha de creación:</strong> {{ $laboratorio->created_at->format('d/m/Y H:i') }}<br>
        <strong>🔄 Última actualización:</strong> {{ $laboratorio->updated_at->format('d/m/Y H:i') }}
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="number">{{ $totalComputadoras }}</div>
            <div class="label">Total Computadoras</div>
        </div>
        <div class="summary-item">
            <div class="number">{{ $laboratorio->computadoras->where('estado', 'activo')->count() }}</div>
            <div class="label">Activas</div>
        </div>
        <div class="summary-item">
            <div class="number">{{ $laboratorio->computadoras->where('estado', 'mantenimiento')->count() }}</div>
            <div class="label">Mantenimiento</div>
        </div>
        <div class="summary-item">
            <div class="number">{{ $laboratorio->computadoras->where('estado', 'baja')->count() }}</div>
            <div class="label">Bajas</div>
        </div>
    </div>

    <h4 style="color: #1a1a2e; margin-top: 20px;">Listado de Computadoras</h4>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Marca</th>
                <th>Procesador</th>
                <th>RAM</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laboratorio->computadoras as $index => $computadora)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $computadora->codigo_inventario }}</strong></td>
                <td>{{ $computadora->marca }}</td>
                <td>{{ $computadora->procesador }}</td>
                <td>{{ $computadora->ram_gb }} GB</td>
                <td>
                    @php
                    $estadoClasses = [
                    'activo' => 'badge-success',
                    'mantenimiento' => 'badge-warning',
                    'baja' => 'badge-danger'
                    ];
                    @endphp
                    <span class="badge {{ $estadoClasses[$computadora->estado] ?? 'badge-info' }}">
                        {{ ucfirst($computadora->estado) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #6c757d;">
                    No hay computadoras registradas en este laboratorio
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Administración de Laboratorios - UTIC</p>
        <p>Total de computadoras: {{ $totalComputadoras }}</p>
    </div>
</body>

</html>