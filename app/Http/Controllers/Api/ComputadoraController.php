<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Computadora;
use Illuminate\Http\Request;

class ComputadoraController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Computadora::with('laboratorio');

            // Filtro por marca
            if ($request->has('marca') && !empty($request->marca)) {
                $query->where('marca', 'LIKE', '%' . $request->marca . '%');
            }

            // Filtro por estado
            if ($request->has('estado') && !empty($request->estado)) {
                $query->where('estado', $request->estado);
            }

            // Filtro por laboratorio
            if ($request->has('laboratorio') && !empty($request->laboratorio)) {
                $query->where('laboratorio_id', $request->laboratorio);
            }

            $perPage = $request->get('per_page', 10);
            $computadoras = $query->paginate($perPage);

            $data = $computadoras->map(function ($computadora) {
                return [
                    'id' => $computadora->id,
                    'codigo_inventario' => $computadora->codigo_inventario,
                    'marca' => $computadora->marca,
                    'procesador' => $computadora->procesador,
                    'ram_gb' => $computadora->ram_gb,
                    'estado' => $computadora->estado,
                    'laboratorio' => [
                        'id' => $computadora->laboratorio->id ?? null,
                        'nombre' => $computadora->laboratorio->nombre ?? 'Sin laboratorio',
                        'ubicacion' => $computadora->laboratorio->ubicacion ?? 'Sin ubicación',
                    ],
                    'created_at' => $computadora->created_at ? $computadora->created_at->format('d/m/Y H:i') : null,
                ];
            });

            return response()->json([
                'data' => $data,
                'current_page' => $computadoras->currentPage(),
                'last_page' => $computadoras->lastPage(),
                'per_page' => $computadoras->perPage(),
                'total' => $computadoras->total(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al cargar los datos',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $computadora = Computadora::with('laboratorio')->findOrFail($id);

            return response()->json([
                'id' => $computadora->id,
                'codigo_inventario' => $computadora->codigo_inventario,
                'marca' => $computadora->marca,
                'procesador' => $computadora->procesador,
                'ram_gb' => $computadora->ram_gb,
                'estado' => $computadora->estado,
                'laboratorio' => [
                    'id' => $computadora->laboratorio->id ?? null,
                    'nombre' => $computadora->laboratorio->nombre ?? 'Sin laboratorio',
                    'ubicacion' => $computadora->laboratorio->ubicacion ?? 'Sin ubicación',
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Computadora no encontrada'], 404);
        }
    }
}
