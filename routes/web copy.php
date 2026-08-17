<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\ReporteController;

// Página principal
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Rutas de recursos para CRUD
Route::resource('grupos', GrupoController::class);
Route::resource('oficinas', OficinaController::class);
Route::resource('responsables', ResponsableController::class);
Route::resource('activos', ActivoController::class);

// Rutas para reportes
Route::prefix('reportes')->group(function () {
    Route::get('/activos-pdf', [ReporteController::class, 'activosPDF'])->name('reportes.activos-pdf');
    Route::get('/activos-qr', [ReporteController::class, 'activosQR'])->name('reportes.activos-qr');
});
