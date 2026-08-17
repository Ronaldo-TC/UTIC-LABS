<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class LaboratorioController extends Controller
{
    /**
     * Listar todos los laboratorios
     */
    public function index()
    {
        $laboratorios = Laboratorio::withCount('computadoras')->get();
        return view('laboratorios.index', compact('laboratorios'));
    }

    /**
     * Mostrar formulario para crear un nuevo laboratorio
     */
    public function create()
    {
        return view('laboratorios.create');
    }

    /**
     * Guardar un nuevo laboratorio
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|min:3|max:100',
            'ubicacion' => 'required|string|max:100',
        ]);

        Laboratorio::create($validated);

        return redirect()->route('laboratorios.index')
            ->with('success', 'Laboratorio creado exitosamente.');
    }

    /**
     * Mostrar los detalles de un laboratorio específico
     */
    public function show(Laboratorio $laboratorio)
    {
        // Cargar las computadoras del laboratorio
        $laboratorio->load('computadoras');

        // Contar por estado
        $totalComputadoras = $laboratorio->computadoras->count();
        $activas = $laboratorio->computadoras->where('estado', 'activo')->count();
        $mantenimiento = $laboratorio->computadoras->where('estado', 'mantenimiento')->count();
        $bajas = $laboratorio->computadoras->where('estado', 'baja')->count();

        return view('laboratorios.show', compact(
            'laboratorio',
            'totalComputadoras',
            'activas',
            'mantenimiento',
            'bajas'
        ));
    }

    /**
     * Mostrar formulario para editar un laboratorio
     */
    public function edit(Laboratorio $laboratorio)
    {
        return view('laboratorios.edit', compact('laboratorio'));
    }

    /**
     * Actualizar un laboratorio
     */
    public function update(Request $request, Laboratorio $laboratorio)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|min:3|max:100',
            'ubicacion' => 'required|string|max:100',
        ]);

        $laboratorio->update($validated);

        return redirect()->route('laboratorios.index')
            ->with('success', 'Laboratorio actualizado exitosamente.');
    }

    /**
     * Eliminar un laboratorio (con verificación de computadoras)
     */
    public function destroy(Laboratorio $laboratorio)
    {
        // Verificar si tiene computadoras asociadas
        if ($laboratorio->computadoras()->count() > 0) {
            return redirect()->route('laboratorios.index')
                ->with('error', 'No se puede eliminar el laboratorio porque tiene computadoras asociadas.');
        }

        $laboratorio->delete();

        return redirect()->route('laboratorios.index')
            ->with('success', 'Laboratorio eliminado exitosamente.');
    }

    /**
     * Generar reporte PDF de todos los laboratorios
     */
    public function reportePDF()
    {
        $laboratorios = Laboratorio::withCount('computadoras')->get();
        $totalLaboratorios = $laboratorios->count();
        $totalComputadoras = $laboratorios->sum('computadoras_count');

        $pdf = Pdf::loadView('reportes.laboratorios', compact(
            'laboratorios',
            'totalLaboratorios',
            'totalComputadoras'
        ));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('reporte_laboratorios_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Generar reporte PDF de un laboratorio específico con sus computadoras
     */
    public function reporteLaboratorioPDF(Laboratorio $laboratorio)
    {
        $laboratorio->load('computadoras');
        $totalComputadoras = $laboratorio->computadoras->count();

        $pdf = Pdf::loadView('reportes.laboratorio-detalle', compact(
            'laboratorio',
            'totalComputadoras'
        ));

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('laboratorio_' . $laboratorio->nombre . '_' . date('Y-m-d') . '.pdf');
    }
}
