<!-- resources/views/reportes/computadoras.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reporte de Computadoras</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            padding: 20px;
            background: #fff;
        }

        .header {
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 3px solid #4361ee;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 22px;
            color: #1a1a2e;
            margin-bottom: 5px;
        }

        .header p {
            color: #6c757d;
            font-size: 12px;
        }

        .summary {
            display: flex;
            justify-content: space-around;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .summary-item {
            text-align: center;
        }

        .summary-item .number {
            font-size: 20px;
            font-weight: bold;
        }

        .summary-item .number.text-primary {
            color: #4361ee;
        }

        .summary-item .number.text-success {
            color: #28a745;
        }

        .summary-item .number.text-warning {
            color: #ffc107;
        }

        .summary-item .number.text-danger {
            color: #dc3545;
        }

        .summary-item .label {
            font-size: 10px;
            color: #6c757d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background: #4361ee;
            color: white;
            padding: 8px 10px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 6px 10px;
            border-bottom: 1px solid #e9ecef;
            font-size: 10px;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 9px;
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
            margin-top: 20px;
            text-align: center;
            font-size: 9px;
            color: #95a5a6;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .text-muted {
            color: #6c757d;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>💻 Reporte de Computadoras</h1>
        <p>Fecha de generación: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="number text-primary">{{ $total }}</div>
            <div class="label">Total Computadoras</div>
        </div>
        <div class="summary-item">
            <div class="number text-success">{{ $activas }}</div>
            <div class="label">Activas</div>
        </div>
        <div class="summary-item">
            <div class="number text-warning">{{ $mantenimiento }}</div>
            <div class="label">Mantenimiento</div>
        </div>
        <div class="summary-item">
            <div class="number text-danger">{{ $bajas }}</div>
            <div class="label">Bajas</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Marca</th>
                <th>Procesador</th>
                <th>RAM</th>
                <th>Estado</th>
                <th>Laboratorio</th>
                <th>Ubicación</th>
            </tr>
        </thead>
        <tbody>
            @forelse($computadoras as $index => $computadora)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $computadora->codigo_inventario }}</strong></td>
                <td>{{ $computadora->marca }}</td>
                <td>{{ $computadora->procesador }}</td>
                <td>{{ $computadora->ram_gb }} GB</td>
                <td>
                    @php
                    $classes = [
                    'activo' => 'badge-success',
                    'mantenimiento' => 'badge-warning',
                    'baja' => 'badge-danger'
                    ];
                    @endphp
                    <span class="badge {{ $classes[$computadora->estado] ?? 'badge-info' }}">
                        {{ ucfirst($computadora->estado) }}
                    </span>
                </td>
                <td>{{ $computadora->laboratorio->nombre ?? 'Sin laboratorio' }}</td>
                <td>{{ $computadora->laboratorio->ubicacion ?? 'N/A' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center text-muted">No hay computadoras registradas</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Sistema de Administración de Laboratorios - UTIC</p>
        <p>Total de registros: {{ $total }}</p>
    </div>
</body>

</html>