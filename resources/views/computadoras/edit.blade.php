<!-- resources/views/computadoras/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-modern">
            <div class="card-header">
                <div>
                    <h5 class="mb-0"><i class="bi bi-pencil me-2"></i>Editar Computadora</h5>
                    <small class="text-muted">Modifica los datos de la computadora</small>
                </div>
                <a href="{{ route('computadoras.index') }}" class="btn btn-outline-custom btn-sm">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('computadoras.update', $computadora) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="laboratorio_id" class="form-label-modern">
                                Laboratorio <span class="required">*</span>
                            </label>
                            <select name="laboratorio_id" id="laboratorio_id"
                                class="form-select form-control-modern @error('laboratorio_id') is-invalid @enderror" required>
                                <option value="">Seleccione un laboratorio</option>
                                @foreach($laboratorios as $laboratorio)
                                <option value="{{ $laboratorio->id }}" {{ old('laboratorio_id', $computadora->laboratorio_id) == $laboratorio->id ? 'selected' : '' }}>
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
                                value="{{ old('codigo_inventario', $computadora->codigo_inventario) }}"
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
                                value="{{ old('marca', $computadora->marca) }}"
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
                                value="{{ old('procesador', $computadora->procesador) }}"
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
                                value="{{ old('ram_gb', $computadora->ram_gb) }}"
                                min="1"
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
                                <option value="activo" {{ old('estado', $computadora->estado) == 'activo' ? 'selected' : '' }}>🟢 Activo</option>
                                <option value="mantenimiento" {{ old('estado', $computadora->estado) == 'mantenimiento' ? 'selected' : '' }}>🟡 Mantenimiento</option>
                                <option value="baja" {{ old('estado', $computadora->estado) == 'baja' ? 'selected' : '' }}>🔴 Baja</option>
                            </select>
                            @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-save"></i> Actualizar Computadora
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