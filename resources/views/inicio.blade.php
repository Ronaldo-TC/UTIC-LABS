@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        <i class="fas fa-home"></i>
                        Sistema de Gestión de Activos Fijos
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Bienvenido al Sistema de Gestión de Activos Fijos</h4>
                            <p class="lead">
                                Este sistema permite administrar todos los activos fijos de la organización,
                                asignar responsables, generar reportes y mantener un control eficiente del
                                inventario.
                            </p>

                            <div class="row mt-4">
                                <div class="col-md-3">
                                    <div class="info-box bg-info">
                                        <span class="info-box-icon">
                                            <i class="fas fa-laptop"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Activos</span>
                                            <span class="info-box-number">
                                                {{ App\Models\Activo::count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="info-box bg-success">
                                        <span class="info-box-icon">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Responsables</span>
                                            <span class="info-box-number">
                                                {{ App\Models\Responsable::count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="info-box bg-warning">
                                        <span class="info-box-icon">
                                            <i class="fas fa-building"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Oficinas</span>
                                            <span class="info-box-number">
                                                {{ App\Models\Oficina::count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="info-box bg-danger">
                                        <span class="info-box-icon">
                                            <i class="fas fa-boxes"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Grupos</span>
                                            <span class="info-box-number">
                                                {{ App\Models\Grupo::count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Acciones Rápidas</h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('activos.create') }}" class="btn btn-primary btn-block mb-2">
                                        <i class="fas fa-plus"></i> Nuevo Activo
                                    </a>
                                    <a href="{{ route('reportes.activos-pdf') }}" class="btn btn-danger btn-block mb-2" target="_blank">
                                        <i class="fas fa-file-pdf"></i> Generar PDF
                                    </a>
                                    <a href="{{ route('reportes.activos-qr') }}" class="btn btn-success btn-block mb-2">
                                        <i class="fas fa-qrcode"></i> Ver Códigos QR
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection