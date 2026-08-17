@extends('layouts.app')

@section('title', 'Inicio')
@section('icon', 'fa-home')

@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <!-- Estadísticas -->
    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Activos</h6>
                        <h2 class="mb-0">{{ $stats['activos'] }}</h2>
                    </div>
                    <i class="fas fa-laptop fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Responsables</h6>
                        <h2 class="mb-0">{{ $stats['responsables'] }}</h2>
                    </div>
                    <i class="fas fa-users fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Valor Total</h6>
                        <h2 class="mb-0">${{ number_format($stats['valor_total'], 2) }}</h2>
                    </div>
                    <i class="fas fa-dollar-sign fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card stat-card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Activos Activos</h6>
                        <h2 class="mb-0">{{ $stats['activos_activos'] }}</h2>
                    </div>
                    <i class="fas fa-check-circle fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Últimos Activos -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-custom">
                <h5 class="mb-0">
                    <i class="fas fa-history me-2"></i>
                    Últimos Activos Registrados
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descripción</th>
                                <th>Responsable</th>
                                <th>Precio</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ultimos_activos as $activo)
                            <tr>
                                <td>
                                    <strong>{{ $activo->codigo }}</strong>
                                </td>
                                <td>{{ Str::limit($activo->descrip, 30) }}</td>
                                <td>{{ $activo->responsable->nombre }}</td>
                                <td>${{ number_format($activo->precio, 2) }}</td>
                                <td>
                                    @if($activo->estado == 'activo')
                                    <span class="badge bg-success">Activo</span>
                                    @elseif($activo->estado == 'inactivo')
                                    <span class="badge bg-danger">Inactivo</span>
                                    @else
                                    <span class="badge bg-warning">Mantenimiento</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('activos.index') }}" class="btn btn-primary">
                        <i class="fas fa-eye me-1"></i> Ver Todos los Activos
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-custom">
                <h5 class="mb-0">
                    <i class="fas fa-bolt me-2"></i>
                    Acciones Rápidas
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('activos.create') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i> Nuevo Activo
                    </a>

                    <a href="{{ route('responsables.create') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-user-plus me-2"></i> Nuevo Responsable
                    </a>

                    <a href="{{ route('reportes.activos-pdf') }}" class="btn btn-danger btn-lg" target="_blank">
                        <i class="fas fa-file-pdf me-2"></i> Generar Reporte PDF
                    </a>

                    <a href="{{ route('reportes.activos-qr') }}" class="btn btn-warning btn-lg">
                        <i class="fas fa-qrcode me-2"></i> Ver Códigos QR
                    </a>
                </div>

                <hr>

                <h6 class="mt-3">Estadísticas por Estado</h6>
                <div class="list-group">
                    <div class="list-group-item d-flex justify-content-between">
                        <span><i class="fas fa-circle text-success me-2"></i> Activos</span>
                        <span class="badge bg-success rounded-pill">{{ $stats['activos_activos'] }}</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between">
                        <span><i class="fas fa-circle text-danger me-2"></i> Inactivos</span>
                        <span class="badge bg-danger rounded-pill">{{ $stats['activos'] - $stats['activos_activos'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection