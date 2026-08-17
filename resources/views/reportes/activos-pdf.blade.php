<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reporte de Activos Fijos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h1 {
            color: #2c3e50;
            margin: 0;
        }

        .header p {
            color: #7f8c8d;
            margin: 5px 0;
        }

        .info-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: left;
        }

        .table td {
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10px;
            color: #7f8c8d;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .badge {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }

        .badge-activo {
            background-color: #28a745;
            color: white;
        }

        .badge-inactivo {
            background-color: #dc3545;
            color: white;
        }

        .badge-mantenimiento {
            background-color: #ffc107;
            color: black;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>REPORTE DE ACTIVOS FIJOS</h1>
        <p>Sistema de Gestión de Activos - {{ date('d/m/Y H:i:s') }}</p>
        <p>Total de Activos: {{ $activos->count() }}</p>
    </div>

    <div class="info-box">
        <strong>Información del Reporte:</strong><br>
        Fecha de generación: {{ date('d/m/Y H:i:s') }}<br>
        Total registros: {{ $activos->count() }}<br>
        Valor total: ${{ number_format($activos->sum('precio'), 2) }}
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Responsable</th>
                <th>Oficina</th>
                <th>Precio</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activos as $activo)
            <tr>
                <td><strong>{{ $activo->codigo }}</strong></td>
                <td>{{ $activo->descrip }}</td>
                <td>{{ $activo->responsable->nombre }}</td>
                <td>{{ $activo->oficina->nombre }}</td>
                <td class="text-right">${{ number_format($activo->precio, 2) }}</td>
                <td>{{ $activo->fecha->format('d/m/Y') }}</td>
                <td>
                    @if($activo->estado == 'activo')
                    <span class="badge badge-activo">ACTIVO</span>
                    @elseif($activo->estado == 'inactivo')
                    <span class="badge badge-inactivo">INACTIVO</span>
                    @elseif($activo->estado == 'mantenimiento')
                    <span class="badge badge-mantenimiento">MANTENIMIENTO</span>
                    @else
                    <span class="badge badge-inactivo">BAJA</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>TOTAL:</strong></td>
                <td class="text-right"><strong>${{ number_format($activos->sum('precio'), 2) }}</strong></td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Gestión de Activos Fijos</p>
        <p>© {{ date('Y') }} - Todos los derechos reservados</p>
    </div>
</body>

</html>