<?php

use App\Http\Controllers\ComputadoraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ============================================
// RUTAS PARA LABORATORIOS
// ============================================
Route::resource('laboratorios', LaboratorioController::class);

// ============================================
// RUTAS PARA COMPUTADORAS
// ============================================
Route::resource('computadoras', ComputadoraController::class);

// ============================================
// RUTAS PARA REPORTES PDF
// ============================================
Route::prefix('reportes')->name('reportes.')->group(function () {
    // Reporte de computadoras
    Route::get('computadoras', [ReporteController::class, 'reporteComputadoras'])->name('computadoras');

    // Reporte de laboratorios
    Route::get('laboratorios', [ReporteController::class, 'reporteLaboratorios'])->name('laboratorios');

    // Reporte de laboratorio específico
    Route::get('laboratorio/{laboratorio}', [ReporteController::class, 'reporteLaboratorioDetalle'])->name('laboratorio.detalle');

    // Reporte por estado
    Route::get('computadoras/estado/{estado}', [ReporteController::class, 'reporteComputadorasPorEstado'])->name('computadoras.estado');

    // Reporte por marca
    Route::get('computadoras/marca', [ReporteController::class, 'reporteComputadorasPorMarca'])->name('computadoras.marca');

    // Resumen ejecutivo
    Route::get('resumen', [ReporteController::class, 'reporteResumen'])->name('resumen');
});

// Ruta antigua (mantener por compatibilidad)
Route::get('reporte/pdf', [ReporteController::class, 'generarPDF'])->name('reporte.pdf');
