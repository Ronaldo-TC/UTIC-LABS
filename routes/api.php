<?php

use App\Http\Controllers\Api\ComputadoraController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Ruta de prueba
Route::get('/test', function () {
    return response()->json([
        'message' => 'API funcionando correctamente',
        'status' => 'ok'
    ]);
});

// Rutas para computadoras
Route::get('/computadoras', [ComputadoraController::class, 'index']);
Route::get('/computadoras/{id}', [ComputadoraController::class, 'show']);
