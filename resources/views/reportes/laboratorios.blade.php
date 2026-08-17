<!-- resources/views/reportes/laboratorios.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reporte de Laboratorios</title>
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
            color: #4361ee;
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

        .badge-info {
            background: #cce5ff;
            color: #004085;
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

        .text-success {
            color: #28a745;
        }

        .text-warning {
            color: #ffc107;
        }

        .text-danger {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>🏢 Reporte de Laboratorios</h1>
        <p>Fecha de generación: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="number">{{ $totalLaboratorios }}</div>
            <div class="label">Total Laboratorios</div>
        </div>
        <div class="summary-item">
            <div class="number">{{ $totalComputadoras }}</div>
            <div class="label">Total Computadoras</div>
        </div>
        <div class="summary-item">
            <div class="number">{{ $totalLaboratorios > 0 ? round($totalComputadoras / $totalLaboratorios, 1) : 0 }}</div>
            <div class="label">Promedio por Lab</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Computadoras</th>
                <th>Fecha Creación</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laboratorios as $index => $laboratorio)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $laboratorio->nombre }}</strong></td>
                <td>{{ $laboratorio->ubicacion }}</td>
                <td>
                    <span class="badge badge-info">{{ $laboratorio->computadoras_count }} equipos</span>
                </td>
                <td>{{ $laboratorio->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">No hay laboratorios registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Sistema de Administración de Laboratorios - UTIC</p>
        <p>Total de registros: {{ $totalLaboratorios }}</p>
    </div>
</body>

</html>