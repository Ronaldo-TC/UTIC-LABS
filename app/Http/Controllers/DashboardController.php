<?php

namespace App\Http\Controllers;

use App\Models\Computadora;
use App\Models\Laboratorio;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener todas las estadísticas
        $stats = $this->getEstadisticas();

        // Datos para gráficos
        $charts = $this->getChartData();

        // Últimos registros
        $ultimasComputadoras = Computadora::with('laboratorio')
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard', [
            'stats' => $stats,
            'charts' => $charts,
            'ultimasComputadoras' => $ultimasComputadoras,
            // Variables individuales para la vista
            'totalLaboratorios' => $stats['totalLaboratorios'],
            'totalComputadoras' => $stats['totalComputadoras'],
            'computadorasActivas' => $stats['activas'],
            'computadorasMantenimiento' => $stats['mantenimiento'],
            'computadorasBajas' => $stats['bajas'],
            'labLabels' => $charts['labLabels'],
            'labData' => $charts['labData'],
            'activos' => $stats['activas'],
            'mantenimiento' => $stats['mantenimiento'],
            'bajas' => $stats['bajas'],
        ]);
    }

    private function getEstadisticas()
    {
        return [
            'totalLaboratorios' => Laboratorio::count(),
            'totalComputadoras' => Computadora::count(),
            'activas' => Computadora::where('estado', 'activo')->count(),
            'mantenimiento' => Computadora::where('estado', 'mantenimiento')->count(),
            'bajas' => Computadora::where('estado', 'baja')->count(),
        ];
    }

    private function getChartData()
    {
        $laboratorios = Laboratorio::withCount('computadoras')->get();

        return [
            'labLabels' => $laboratorios->pluck('nombre'),
            'labData' => $laboratorios->pluck('computadoras_count'),
        ];
    }
}
