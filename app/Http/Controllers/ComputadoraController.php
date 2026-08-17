<?php

namespace App\Http\Controllers;

use App\Models\Computadora;
use App\Models\Laboratorio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComputadoraController extends Controller
{
    public function index(Request $request)
    {
        // Obtener todos los laboratorios para el filtro
        $laboratorios = Laboratorio::all();

        // Construir la consulta
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

        // Ordenar y paginar
        $computadoras = $query->latest()->paginate(10);

        // Mantener los filtros en la paginación
        $computadoras->appends($request->all());

        return view('computadoras.index', compact('computadoras', 'laboratorios'));
    }

    public function create()
    {
        $laboratorios = Laboratorio::all();
        return view('computadoras.create', compact('laboratorios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'laboratorio_id' => 'required|exists:laboratorios,id',
            'codigo_inventario' => 'required|string|max:50|unique:computadoras',
            'marca' => 'required|string|max:50',
            'procesador' => 'required|string|max:50',
            'ram_gb' => 'required|integer|min:1',
            'estado' => ['required', Rule::in(['activo', 'mantenimiento', 'baja'])],
        ]);

        Computadora::create($validated);

        return redirect()->route('computadoras.index')
            ->with('success', 'Computadora registrada exitosamente.');
    }

    public function edit(Computadora $computadora)
    {
        $laboratorios = Laboratorio::all();
        return view('computadoras.edit', compact('computadora', 'laboratorios'));
    }

    public function update(Request $request, Computadora $computadora)
    {
        $validated = $request->validate([
            'laboratorio_id' => 'required|exists:laboratorios,id',
            'codigo_inventario' => [
                'required',
                'string',
                'max:50',
                Rule::unique('computadoras')->ignore($computadora->id),
            ],
            'marca' => 'required|string|max:50',
            'procesador' => 'required|string|max:50',
            'ram_gb' => 'required|integer|min:1',
            'estado' => ['required', Rule::in(['activo', 'mantenimiento', 'baja'])],
        ]);

        $computadora->update($validated);

        return redirect()->route('computadoras.index')
            ->with('success', 'Computadora actualizada exitosamente.');
    }

    public function destroy(Computadora $computadora)
    {
        $computadora->delete();

        return redirect()->route('computadoras.index')
            ->with('success', 'Computadora eliminada exitosamente.');
    }
}
