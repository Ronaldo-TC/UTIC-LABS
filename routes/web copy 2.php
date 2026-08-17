<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController; // Nuevo

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas CRUD
Route::resource('grupos', GrupoController::class);
Route::resource('oficinas', OficinaController::class);
Route::resource('responsables', ResponsableController::class);
Route::resource('activos', ActivoController::class);

// Reportes
Route::get('/reportes/activos-pdf', [ReporteController::class, 'activosPDF'])->name('reportes.activos-pdf');
Route::get('/reportes/activos-qr', [ReporteController::class, 'activosQR'])->name('reportes.activos-qr');

// Rutas de autenticación (simuladas)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
