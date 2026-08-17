<!-- resources/views/computadoras/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-modern">
            <div class="card-header">
                <div>
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Nueva Computadora</h5>
                    <small class="text-muted">Registra una nueva computadora en el sistema</small>
                </div>
                <a href="{{ route('computadoras.index') }}" class="btn btn-outline-custom btn-sm">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('computadoras.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="laboratorio_id" class="form-label-modern">
                                Laboratorio <span class="required">*</span>
                            </label>
                            <select name="laboratorio_id" id="laboratorio_id"
                                class="form-select form-control-modern @error('laboratorio_id') is-invalid @enderror" required>
                                <option value="">Seleccione un laboratorio</option>
                                @foreach($laboratorios as $laboratorio)
                                <option value="{{ $laboratorio->id }}" {{ old('laboratorio_id') == $laboratorio->id ? 'selected' : '' }}>
                                    {{ $laboratorio->nombre }} - {{ $laboratorio->ubicacion }}
                                </option>
                                @endforeach
                            </select>
                            @error('laboratorio_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="codigo_inventario" class="form-label-modern">
                                Código de Inventario <span class="required">*</span>
                            </label>
                            <input type="text"
                                name="codigo_inventario"
                                id="codigo_inventario"
                                class="form-control form-control-modern @error('codigo_inventario') is-invalid @enderror"
                                value="{{ old('codigo_inventario') }}"
                                placeholder="Ej: PC-001"
                                required>
                            @error('codigo_inventario')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="marca" class="form-label-modern">
                                Marca <span class="required">*</span>
                            </label>
                            <input type="text"
                                name="marca"
                                id="marca"
                                class="form-control form-control-modern @error('marca') is-invalid @enderror"
                                value="{{ old('marca') }}"
                                placeholder="Ej: Dell, HP, Lenovo"
                                required>
                            @error('marca')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="procesador" class="form-label-modern">
                                Procesador <span class="required">*</span>
                            </label>
                            <input type="text"
                                name="procesador"
                                id="procesador"
                                class="form-control form-control-modern @error('procesador') is-invalid @enderror"
                                value="{{ old('procesador') }}"
                                placeholder="Ej: Intel Core i7-10700"
                                required>
                            @error('procesador')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="ram_gb" class="form-label-modern">
                                RAM (GB) <span class="required">*</span>
                            </label>
                            <input type="number"
                                name="ram_gb"
                                id="ram_gb"
                                class="form-control form-control-modern @error('ram_gb') is-invalid @enderror"
                                value="{{ old('ram_gb') }}"
                                min="1"
                                placeholder="8"
                                required>
                            @error('ram_gb')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="estado" class="form-label-modern">
                                Estado <span class="required">*</span>
                            </label>
                            <select name="estado" id="estado"
                                class="form-select form-control-modern @error('estado') is-invalid @enderror" required>
                                <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>🟢 Activo</option>
                                <option value="mantenimiento" {{ old('estado') == 'mantenimiento' ? 'selected' : '' }}>🟡 Mantenimiento</option>
                                <option value="baja" {{ old('estado') == 'baja' ? 'selected' : '' }}>🔴 Baja</option>
                            </select>
                            @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-save"></i> Guardar Computadora
                        </button>
                        <a href="{{ route('computadoras.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection