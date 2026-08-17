<!-- resources/views/computadoras/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="card-modern">
    <div class="card-header">
        <div>
            <h5 class="mb-0"><i class="bi bi-laptop me-2"></i>Gestión de Computadoras</h5>
            <small class="text-muted">Administra todas las computadoras del sistema</small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('reportes.computadoras') }}" class="btn btn-danger" target="_blank">
                <i class="bi bi-file-pdf"></i> Reporte PDF
            </a>
            <a href="{{ route('reportes.resumen') }}" class="btn btn-info" target="_blank">
                <i class="bi bi-file-pdf"></i> Resumen
            </a>
            <a href="{{ route('computadoras.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-circle"></i> Nueva Computadora
            </a>
        </div>
    </div>
    <div class="card-body">
        <!-- Filtros -->
        <form method="GET" action="{{ route('computadoras.index') }}" id="filterForm">
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-2">
                            <i class="bi bi-search text-primary"></i>
                        </span>
                        <input type="text"
                            name="marca"
                            class="form-control form-control-modern"
                            placeholder="Buscar por marca..."
                            value="{{ request('marca') }}">
                        @if(request('marca'))
                        <a href="{{ route('computadoras.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg"></i>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="estado" class="form-select form-control-modern">
                        <option value="">Todos los estados</option>
                        <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>🟢 Activo</option>
                        <option value="mantenimiento" {{ request('estado') == 'mantenimiento' ? 'selected' : '' }}>🟡 Mantenimiento</option>
                        <option value="baja" {{ request('estado') == 'baja' ? 'selected' : '' }}>🔴 Baja</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="laboratorio" class="form-select form-control-modern">
                        <option value="">Todos los laboratorios</option>
                        @foreach($laboratorios ?? [] as $laboratorio)
                        <option value="{{ $laboratorio->id }}" {{ request('laboratorio') == $laboratorio->id ? 'selected' : '' }}>
                            {{ $laboratorio->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary-custom w-100">
                        <i class="bi bi-funnel"></i> Filtrar
                    </button>
                </div>
            </div>
        </form>

        <!-- Contador de registros -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="badge bg-primary p-2">
                <i class="bi bi-database me-1"></i>
                {{ $computadoras->total() ?? 0 }} registros
            </span>
            <div>
                <a href="{{ route('computadoras.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i> Limpiar filtros
                </a>
            </div>
        </div>

        <!-- Tabla de resultados -->
        <div class="table-responsive">
            <table class="table table-modern">
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
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($computadoras ?? [] as $index => $computadora)
                    <tr>
                        <td>{{ $computadoras->firstItem() + $index }}</td>
                        <td><strong>{{ $computadora->codigo_inventario }}</strong></td>
                        <td>
                            <i class="bi bi-laptop text-primary me-1"></i>
                            {{ $computadora->marca }}
                        </td>
                        <td><small>{{ $computadora->procesador }}</small></td>
                        <td><span class="badge bg-info">{{ $computadora->ram_gb }} GB</span></td>
                        <td>
                            @php
                            $estadoClasses = [
                            'activo' => 'badge-success',
                            'mantenimiento' => 'badge-warning',
                            'baja' => 'badge-danger'
                            ];
                            @endphp
                            <span class="badge {{ $estadoClasses[$computadora->estado] ?? 'badge-secondary' }} p-2">
                                {{ ucfirst($computadora->estado) }}
                            </span>
                        </td>
                        <td>{{ $computadora->laboratorio->nombre ?? 'Sin laboratorio' }}</td>
                        <td>{{ $computadora->laboratorio->ubicacion ?? 'N/A' }}</td>
                        <td><small>{{ $computadora->created_at->format('d/m/Y H:i') }}</small></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('computadoras.edit', $computadora) }}"
                                    class="btn btn-warning"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button"
                                    class="btn btn-danger"
                                    title="Eliminar"
                                    onclick="confirmDelete('{{ route('computadoras.destroy', $computadora) }}', '{{ $computadora->codigo_inventario }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                            <p class="text-muted mb-0">No se encontraron computadoras</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <small class="text-muted">
                    Mostrando {{ $computadoras->firstItem() ?? 0 }} - {{ $computadoras->lastItem() ?? 0 }} de {{ $computadoras->total() ?? 0 }} registros
                </small>
            </div>
            <div>
                {{ $computadoras->links('pagination::bootstrap-5') ?? '' }}
            </div>
        </div>
    </div>
</div>
@endsection