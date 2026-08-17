@extends('layouts.app')

@section('title', 'Códigos QR de Activos')
@section('icon', 'fa-qrcode')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
<li class="breadcrumb-item active">Códigos QR</li>
@endsection

@section('actions')
<a href="{{ route('reportes.activos-pdf') }}" class="btn btn-danger" target="_blank">
    <i class="fas fa-file-pdf me-1"></i> PDF
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header card-header-custom">
        <h5 class="mb-0">
            <i class="fas fa-qrcode me-2"></i>
            Códigos QR de Activos
        </h5>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            Estos códigos QR contienen información básica de cada activo. Pueden ser escaneados para acceder rápidamente a la información.
        </div>

        <div class="row">
            @foreach($activos as $activo)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h6 class="card-title text-primary">
                            <i class="fas fa-barcode me-1"></i>
                            {{ $activo->codigo }}
                        </h6>

                        <div class="mb-3">
                            {!! $activo->qr_code !!}
                        </div>

                        <p class="card-text small mb-1">
                            <strong>Descripción:</strong><br>
                            {{ Str::limit($activo->descrip, 40) }}
                        </p>

                        <p class="card-text small mb-1">
                            <strong>Responsable:</strong><br>
                            {{ $activo->responsable->nombre }}
                        </p>

                        <p class="card-text small mb-1">
                            <strong>Precio:</strong><br>
                            ${{ number_format($activo->precio, 2) }}
                        </p>

                        <span class="badge bg-{{ $activo->estado == 'activo' ? 'success' : ($activo->estado == 'inactivo' ? 'danger' : 'warning') }}">
                            {{ strtoupper($activo->estado) }}
                        </span>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">
                            Generado: {{ now()->format('d/m/Y') }}
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-4 text-center">
            <button class="btn btn-primary" onclick="window.print()">
                <i class="fas fa-print me-1"></i> Imprimir Códigos QR
            </button>
            <a href="{{ route('activos.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver a Activos
            </a>
        </div>
    </div>
</div>
@endsection