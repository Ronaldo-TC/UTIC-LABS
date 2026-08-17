<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row g-4">
    <!-- Tarjeta de Estadísticas -->
    <div class="col-md-3">
        <div class="card-modern">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="bi bi-building fs-2 text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Laboratorios</h6>
                        <h3 class="mb-0">{{ $totalLaboratorios ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-modern">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="bi bi-laptop fs-2 text-success"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Computadoras</h6>
                        <h3 class="mb-0">{{ $totalComputadoras ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-modern">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="bi bi-check-circle fs-2 text-warning"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Activas</h6>
                        <h3 class="mb-0">{{ $computadorasActivas ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-modern">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                        <i class="bi bi-tools fs-2 text-danger"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Mantenimiento</h6>
                        <h3 class="mb-0">{{ $computadorasMantenimiento ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gráficos y más estadísticas -->
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card-modern">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-bar-chart-fill me-2"></i>Distribución por Laboratorio</h5>
            </div>
            <div class="card-body">
                <canvas id="labChart" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-modern">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-pie-chart-fill me-2"></i>Estado de Computadoras</h5>
            </div>
            <div class="card-body">
                <canvas id="statusChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Últimas computadoras registradas -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card-modern">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Últimas Computadoras Registradas</h5>
                <a href="{{ route('computadoras.index') }}" class="btn btn-primary-custom btn-sm">
                    Ver todas <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-modern mb-0">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Marca</th>
                                <th>Laboratorio</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ultimasComputadoras ?? [] as $computadora)
                            <tr>
                                <td><strong>{{ $computadora->codigo_inventario }}</strong></td>
                                <td>{{ $computadora->marca }}</td>
                                <td>{{ $computadora->laboratorio->nombre ?? 'Sin laboratorio' }}</td>
                                <td>
                                    <span class="badge-status badge-{{ $computadora->estado ?? 'activo' }}">
                                        {{ ucfirst($computadora->estado ?? 'N/A') }}
                                    </span>
                                </td>
                                <td>{{ $computadora->created_at ? $computadora->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-3">
                                    <i class="bi bi-inbox text-muted"></i>
                                    No hay computadoras registradas
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Datos para gráficos
        const labLabels = @json($labLabels ?? []);
        const labData = @json($labData ?? []);
        const activos = @json($activos ?? 0);
        const mantenimiento = @json($mantenimiento ?? 0);
        const bajas = @json($bajas ?? 0);

        // Colores para el gráfico de barras
        const colors = ['#4361ee', '#3f37c9', '#4cc9f0', '#f72585', '#f8961e', '#7209b7', '#3a0ca3'];

        // Gráfico de laboratorios
        if (document.getElementById('labChart')) {
            const labCtx = document.getElementById('labChart').getContext('2d');
            new Chart(labCtx, {
                type: 'bar',
                data: {
                    labels: labLabels.length > 0 ? labLabels : ['Sin datos'],
                    datasets: [{
                        label: 'Computadoras',
                        data: labData.length > 0 ? labData : [0],
                        backgroundColor: labData.length > 0 ?
                            labData.map((_, i) => colors[i % colors.length]) : ['#cccccc'],
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }

        // Gráfico de estados
        if (document.getElementById('statusChart')) {
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Activo', 'Mantenimiento', 'Baja'],
                    datasets: [{
                        data: [activos, mantenimiento, bajas],
                        backgroundColor: ['#4cc9f0', '#f8961e', '#f72585'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush