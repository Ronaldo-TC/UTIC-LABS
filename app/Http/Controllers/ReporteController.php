<?php

namespace App\Http\Controllers;

use App\Models\Computadora;
use App\Models\Laboratorio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Reporte PDF de todas las computadoras
     */
    public function reporteComputadoras()
    {
        $computadoras = Computadora::with('laboratorio')->get();
        $total = $computadoras->count();
        $activas = Computadora::where('estado', 'activo')->count();
        $mantenimiento = Computadora::where('estado', 'mantenimiento')->count();
        $bajas = Computadora::where('estado', 'baja')->count();

        $pdf = Pdf::loadView('reportes.computadoras', compact(
            'computadoras',
            'total',
            'activas',
            'mantenimiento',
            'bajas'
        ));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('reporte_computadoras_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Reporte PDF de todas las computadoras (versión simple)
     */
    public function generarPDF()
    {
        return $this->reporteComputadoras();
    }

    /**
     * Reporte PDF de todos los laboratorios
     */
    public function reporteLaboratorios()
    {
        $laboratorios = Laboratorio::withCount('computadoras')->get();
        $totalLaboratorios = $laboratorios->count();
        $totalComputadoras = $laboratorios->sum('computadoras_count');

        // Calcular estadísticas por estado
        $estados = [
            'activo' => Computadora::where('estado', 'activo')->count(),
            'mantenimiento' => Computadora::where('estado', 'mantenimiento')->count(),
            'baja' => Computadora::where('estado', 'baja')->count(),
        ];

        $pdf = Pdf::loadView('reportes.laboratorios', compact(
            'laboratorios',
            'totalLaboratorios',
            'totalComputadoras',
            'estados'
        ));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('reporte_laboratorios_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Reporte PDF de un laboratorio específico con sus computadoras
     */
    public function reporteLaboratorioDetalle(Laboratorio $laboratorio)
    {
        $laboratorio->load('computadoras');
        $totalComputadoras = $laboratorio->computadoras->count();
        $activas = $laboratorio->computadoras->where('estado', 'activo')->count();
        $mantenimiento = $laboratorio->computadoras->where('estado', 'mantenimiento')->count();
        $bajas = $laboratorio->computadoras->where('estado', 'baja')->count();

        $pdf = Pdf::loadView('reportes.laboratorio-detalle', compact(
            'laboratorio',
            'totalComputadoras',
            'activas',
            'mantenimiento',
            'bajas'
        ));

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('laboratorio_' . str_replace(' ', '_', $laboratorio->nombre) . '_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Reporte PDF de computadoras por estado
     */
    public function reporteComputadorasPorEstado($estado)
    {
        $computadoras = Computadora::with('laboratorio')
            ->where('estado', $estado)
            ->get();

        $total = $computadoras->count();
        $estadoNombre = ucfirst($estado);

        $pdf = Pdf::loadView('reportes.computadoras-estado', compact(
            'computadoras',
            'total',
            'estado',
            'estadoNombre'
        ));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('computadoras_' . $estado . '_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Reporte PDF de computadoras por marca
     */
    public function reporteComputadorasPorMarca(Request $request)
    {
        $marca = $request->get('marca');
        $computadoras = Computadora::with('laboratorio')
            ->where('marca', 'LIKE', '%' . $marca . '%')
            ->get();

        $total = $computadoras->count();

        $pdf = Pdf::loadView('reportes.computadoras-marca', compact(
            'computadoras',
            'total',
            'marca'
        ));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('computadoras_marca_' . str_replace(' ', '_', $marca) . '_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Reporte PDF resumen ejecutivo
     */
    public function reporteResumen()
    {
        $totalLaboratorios = Laboratorio::count();
        $totalComputadoras = Computadora::count();
        $activas = Computadora::where('estado', 'activo')->count();
        $mantenimiento = Computadora::where('estado', 'mantenimiento')->count();
        $bajas = Computadora::where('estado', 'baja')->count();

        $laboratorios = Laboratorio::withCount('computadoras')->get();
        $marcasPopulares = Computadora::selectRaw('marca, count(*) as total')
            ->groupBy('marca')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        $pdf = Pdf::loadView('reportes.resumen', compact(
            'totalLaboratorios',
            'totalComputadoras',
            'activas',
            'mantenimiento',
            'bajas',
            'laboratorios',
            'marcasPopulares'
        ));

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('resumen_ejecutivo_' . date('Y-m-d') . '.pdf');
    }
}
