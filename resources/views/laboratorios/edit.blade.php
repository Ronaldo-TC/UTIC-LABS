<!-- resources/views/laboratorios/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-modern">
            <div class="card-header">
                <div>
                    <h5 class="mb-0"><i class="bi bi-pencil me-2"></i>Editar Laboratorio</h5>
                    <small class="text-muted">Modifica los datos del laboratorio</small>
                </div>
                <a href="{{ route('laboratorios.index') }}" class="btn btn-outline-custom btn-sm">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('laboratorios.update', $laboratorio) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nombre" class="form-label-modern">
                            Nombre <span class="required">*</span>
                        </label>
                        <input type="text"
                            name="nombre"
                            id="nombre"
                            class="form-control form-control-modern @error('nombre') is-invalid @enderror"
                            value="{{ old('nombre', $laboratorio->nombre) }}"
                            required>
                        @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="ubicacion" class="form-label-modern">
                            Ubicación <span class="required">*</span>
                        </label>
                        <input type="text"
                            name="ubicacion"
                            id="ubicacion"
                            class="form-control form-control-modern @error('ubicacion') is-invalid @enderror"
                            value="{{ old('ubicacion', $laboratorio->ubicacion) }}"
                            required>
                        @error('ubicacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-save"></i> Actualizar Laboratorio
                        </button>
                        <a href="{{ route('laboratorios.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection