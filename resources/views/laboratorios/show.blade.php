<!-- resources/views/laboratorios/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card-modern">
            <div class="card-header">
                <div>
                    <h5 class="mb-0"><i class="bi bi-building me-2"></i>{{ $laboratorio->nombre }}</h5>
                    <small class="text-muted">{{ $laboratorio->ubicacion }}</small>
                </div>
                <div>
                    <a href="{{ route('laboratorios.index') }}" class="btn btn-outline-custom btn-sm">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('laboratorios.edit', $laboratorio) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <a href="{{ route('laboratorios.reporte.detalle', $laboratorio) }}" class="btn btn-danger btn-sm" target="_blank">
                        <i class="bi bi-file-pdf"></i> PDF
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Información del laboratorio -->
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h3 class="mb-0 text-primary">{{ $totalComputadoras }}</h3>
                                <small class="text-muted">Total Computadoras</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h3 class="mb-0 text-success">{{ $activas }}</h3>
                                <small class="text-muted">Activas</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h3 class="mb-0 text-warning">{{ $mantenimiento }}</h3>
                                <small class="text-muted">Mantenimiento</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h3 class="mb-0 text-danger">{{ $bajas }}</h3>
                                <small class="text-muted">Bajas</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Listado de computadoras del laboratorio -->
                <h6 class="mb-3"><i class="bi bi-laptop me-2"></i>Computadoras en este laboratorio</h6>
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Marca</th>
                                <th>Procesador</th>
                                <th>RAM</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laboratorio->computadoras as $computadora)
                            <tr>
                                <td><strong>{{ $computadora->codigo_inventario }}</strong></td>
                                <td>{{ $computadora->marca }}</td>
                                <td>{{ $computadora->procesador }}</td>
                                <td><span class="badge bg-info">{{ $computadora->ram_gb }} GB</span></td>
                                <td>
                                    @php
                                    $estadoClasses = [
                                    'activo' => 'badge-success',
                                    'mantenimiento' => 'badge-warning',
                                    'baja' => 'badge-danger'
                                    ];
                                    $estadoIcons = [
                                    'activo' => 'bi-check-circle-fill',
                                    'mantenimiento' => 'bi-tools',
                                    'baja' => 'bi-x-circle-fill'
                                    ];
                                    @endphp
                                    <span class="badge {{ $estadoClasses[$computadora->estado] ?? 'badge-secondary' }} p-2">
                                        <i class="bi {{ $estadoIcons[$computadora->estado] ?? 'bi-circle' }} me-1"></i>
                                        {{ ucfirst($computadora->estado) }}
                                    </span>
                                </td>
                                <td>{{ $computadora->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-3">
                                    <i class="bi bi-inbox text-muted"></i>
                                    No hay computadoras registradas en este laboratorio
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Información adicional -->
    <div class="col-md-4">
        <div class="card-modern">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Información</h6>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-5">ID</dt>
                    <dd class="col-sm-7">#{{ $laboratorio->id }}</dd>

                    <dt class="col-sm-5">Nombre</dt>
                    <dd class="col-sm-7">{{ $laboratorio->nombre }}</dd>

                    <dt class="col-sm-5">Ubicación</dt>
                    <dd class="col-sm-7">{{ $laboratorio->ubicacion }}</dd>

                    <dt class="col-sm-5">Creación</dt>
                    <dd class="col-sm-7">{{ $laboratorio->created_at->format('d/m/Y H:i') }}</dd>

                    <dt class="col-sm-5">Actualización</dt>
                    <dd class="col-sm-7">{{ $laboratorio->updated_at->format('d/m/Y H:i') }}</dd>
                </dl>
            </div>
        </div>

        <!-- Acciones rápidas -->
        <div class="card-modern mt-3">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-lightning me-2"></i>Acciones Rápidas</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('computadoras.create') }}?laboratorio={{ $laboratorio->id }}"
                        class="btn btn-primary-custom">
                        <i class="bi bi-plus-circle"></i> Agregar Computadora
                    </a>
                    <a href="{{ route('laboratorios.reporte.detalle', $laboratorio) }}"
                        class="btn btn-danger" target="_blank">
                        <i class="bi bi-file-pdf"></i> Generar PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection