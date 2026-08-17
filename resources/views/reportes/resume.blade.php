<!-- resources/views/reportes/resumen.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Resumen Ejecutivo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
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
            font-size: 24px;
            color: #1a1a2e;
            margin-bottom: 5px;
        }

        .header p {
            color: #6c757d;
            font-size: 13px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
        }

        .card h3 {
            color: #1a1a2e;
            font-size: 14px;
            margin-bottom: 10px;
            border-bottom: 2px solid #4361ee;
            padding-bottom: 5px;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .stat-item:last-child {
            border-bottom: none;
        }

        .stat-item .label {
            color: #6c757d;
        }

        .stat-item .value {
            font-weight: bold;
            color: #1a1a2e;
        }

        .value-primary {
            color: #4361ee !important;
        }

        .value-success {
            color: #28a745 !important;
        }

        .value-warning {
            color: #ffc107 !important;
        }

        .value-danger {
            color: #dc3545 !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #4361ee;
            color: white;
            padding: 6px 10px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
        }

        td {
            padding: 5px 10px;
            border-bottom: 1px solid #e9ecef;
            font-size: 10px;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
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
        <h1>📊 Resumen Ejecutivo</h1>
        <p>Sistema de Administración de Laboratorios - {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <div class="grid-2">
        <div class="card">
            <h3>📈 Estadísticas Generales</h3>
            <div class="stat-item">
                <span class="label">Total Laboratorios</span>
                <span class="value value-primary">{{ $totalLaboratorios }}</span>
            </div>
            <div class="stat-item">
                <span class="label">Total Computadoras</span>
                <span class="value value-primary">{{ $totalComputadoras }}</span>
            </div>
            <div class="stat-item">
                <span class="label">Promedio por Laboratorio</span>
                <span class="value value-primary">{{ $totalLaboratorios > 0 ? round($totalComputadoras / $totalLaboratorios, 1) : 0 }}</span>
            </div>
        </div>

        <div class="card">
            <h3>🔄 Estado de Computadoras</h3>
            <div class="stat-item">
                <span class="label">🟢 Activas</span>
                <span class="value value-success">{{ $activas }}</span>
            </div>
            <div class="stat-item">
                <span class="label">🟡 Mantenimiento</span>
                <span class="value value-warning">{{ $mantenimiento }}</span>
            </div>
            <div class="stat-item">
                <span class="label">🔴 Bajas</span>
                <span class="value value-danger">{{ $bajas }}</span>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom: 20px;">
        <h3>🏢 Distribución por Laboratorio</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Laboratorio</th>
                    <th>Ubicación</th>
                    <th>Computadoras</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laboratorios as $index => $lab)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $lab->nombre }}</strong></td>
                    <td>{{ $lab->ubicacion }}</td>
                    <td>{{ $lab->computadoras_count }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No hay laboratorios</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3>🏷️ Marcas Más Populares</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Marca</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @forelse($marcasPopulares as $index => $marca)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $marca->marca }}</strong></td>
                    <td>{{ $marca->total }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">No hay marcas registradas</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Sistema de Administración de Laboratorios - UTIC</p>
        <p>Reporte generado automáticamente</p>
    </div>
</body>

</html>