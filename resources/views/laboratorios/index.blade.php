<!-- resources/views/laboratorios/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="card-modern">
    <div class="card-header">
        <div>
            <h5 class="mb-0"><i class="bi bi-building me-2"></i>Gestión de Laboratorios</h5>
            <small class="text-muted">Administra los laboratorios de cómputo</small>
        </div>
        <div class="d-flex gap-2">
            <!-- Botón corregido para reporte PDF de laboratorios -->
            <a href="{{ route('reportes.laboratorios') }}" class="btn btn-danger" target="_blank">
                <i class="bi bi-file-pdf"></i> Reporte PDF
            </a>
            <a href="{{ route('reportes.resumen') }}" class="btn btn-info" target="_blank">
                <i class="bi bi-file-pdf"></i> Resumen
            </a>
            <a href="{{ route('laboratorios.create') }}" class="btn btn-primary-custom">
                <i class="bi bi-plus-circle"></i> Nuevo Laboratorio
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Computadoras</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laboratorios as $laboratorio)
                    <tr>
                        <td><span class="badge bg-secondary">#{{ $laboratorio->id }}</span></td>
                        <td>
                            <strong>{{ $laboratorio->nombre }}</strong>
                            @if($laboratorio->computadoras_count > 0)
                            <span class="badge bg-info ms-2">{{ $laboratorio->computadoras_count }} equipos</span>
                            @endif
                        </td>
                        <td><i class="bi bi-geo-alt text-primary me-1"></i>{{ $laboratorio->ubicacion }}</td>
                        <td>
                            <span class="badge-status badge-activo">
                                <i class="bi bi-laptop me-1"></i>
                                {{ $laboratorio->computadoras_count }}
                            </span>
                        </td>
                        <td>{{ $laboratorio->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <!-- Ver detalle -->
                                <a href="{{ route('laboratorios.show', $laboratorio) }}"
                                    class="btn btn-primary"
                                    title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <!-- Editar -->
                                <a href="{{ route('laboratorios.edit', $laboratorio) }}"
                                    class="btn btn-warning"
                                    title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <!-- Reporte PDF del laboratorio específico -->
                                <a href="{{ route('reportes.laboratorio.detalle', $laboratorio) }}"
                                    class="btn btn-info"
                                    title="Reporte PDF"
                                    target="_blank">
                                    <i class="bi bi-file-pdf"></i>
                                </a>
                                <!-- Eliminar -->
                                <button type="button"
                                    class="btn btn-danger"
                                    title="Eliminar"
                                    onclick="confirmDelete('{{ route('laboratorios.destroy', $laboratorio) }}', '{{ $laboratorio->nombre }}', {{ $laboratorio->computadoras_count }})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="bi bi-building fs-1 text-muted d-block mb-2"></i>
                            <p class="text-muted mb-0">No hay laboratorios registrados</p>
                            <a href="{{ route('laboratorios.create') }}" class="btn btn-primary-custom btn-sm mt-2">
                                <i class="bi bi-plus-circle"></i> Crear primer laboratorio
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="deleteMessage">¿Estás seguro de eliminar este laboratorio?</p>
                <div id="deleteWarning" class="alert alert-warning d-none">
                    <i class="bi bi-info-circle me-2"></i>
                    <span id="warningText"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" id="deleteButton">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(url, nombre, computadorasCount) {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        const message = document.getElementById('deleteMessage');
        const warning = document.getElementById('deleteWarning');
        const warningText = document.getElementById('warningText');
        const deleteButton = document.getElementById('deleteButton');
        const form = document.getElementById('deleteForm');

        message.textContent = `¿Estás seguro de eliminar el laboratorio "${nombre}"?`;

        if (computadorasCount > 0) {
            warning.classList.remove('d-none');
            warningText.textContent = `Este laboratorio tiene ${computadorasCount} computadoras asociadas. No se puede eliminar.`;
            deleteButton.disabled = true;
            deleteButton.innerHTML = '<i class="bi bi-x-circle"></i> No se puede eliminar';
        } else {
            warning.classList.add('d-none');
            deleteButton.disabled = false;
            deleteButton.innerHTML = '<i class="bi bi-trash"></i> Eliminar';
        }

        form.action = url;
        modal.show();
    }
</script>
@endpush