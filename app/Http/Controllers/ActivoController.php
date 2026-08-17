<?php

namespace App\Http\Controllers;

use App\Models\Activo;
use App\Models\Grupo;
use App\Models\Oficina;
use App\Models\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivoController extends Controller
{
    // public function index()
    // {
    //     $activos = Activo::with(['responsable', 'oficina', 'grupo'])->get();
    //     $oficinas = Oficina::all(); // Para el filtro
    //     return view('activos.index', compact('activos', 'oficinas'));
    // }

    public function index(Request $request)
    {
        $query = Activo::with(['responsable', 'oficina', 'grupo']);

        // Aplicar filtros
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('oficina_id')) {
            $query->where('oficinas_id', $request->oficina_id);
        }

        if ($request->filled('grupo_id')) {
            $query->where('grupos_id', $request->grupo_id);
        }

        if ($request->filled('responsable_id')) {
            $query->where('responsables_id', $request->responsable_id);
        }

        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }

        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        if ($request->filled('fecha_desde')) {
            $query->where('fecha', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->where('fecha', '<=', $request->fecha_hasta);
        }

        if ($request->filled('con_foto')) {
            $query->whereNotNull('foto');
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('codigo', 'like', '%' . $request->search . '%')
                    ->orWhere('descrip', 'like', '%' . $request->search . '%');
            });
        }

        // Ordenar por defecto
        $query->orderBy('created_at', 'desc');

        // Obtener datos para filtros
        $oficinas = Oficina::all();
        $grupos = Grupo::all();
        $responsables = Responsable::all();

        // Paginar resultados
        $activos = $query->paginate(15)->withQueryString();

        return view('activos.index', compact('activos', 'oficinas', 'grupos', 'responsables'));
    }

    public function create()
    {
        $grupos = Grupo::all();
        $oficinas = Oficina::all();
        $responsables = Responsable::all();
        return view('activos.create', compact('grupos', 'oficinas', 'responsables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:activos|max:50',
            'descrip' => 'required',
            'precio' => 'required|numeric|min:0',
            'fecha' => 'required|date',
            'estado' => 'required|in:activo,inactivo,mantenimiento,baja',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'grupos_id' => 'required|exists:grupos,id',
            'oficinas_id' => 'required|exists:oficinas,id',
            'responsables_id' => 'required|exists:responsables,id',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('activos', 'public');
        }

        Activo::create($data);

        return redirect()->route('activos.index')
            ->with('success', 'Activo creado exitosamente.');
    }

    public function show(Activo $activo)
    {
        $activo->load(['responsable', 'oficina', 'grupo']);
        return view('activos.show', compact('activo'));
    }

    public function edit(Activo $activo)
    {
        $grupos = Grupo::all();
        $oficinas = Oficina::all();
        $responsables = Responsable::all();
        $activo->load(['responsable', 'oficina', 'grupo']);
        return view('activos.edit', compact('activo', 'grupos', 'oficinas', 'responsables'));
    }

    public function update(Request $request, Activo $activo)
    {
        $request->validate([
            'codigo' => 'required|unique:activos,codigo,' . $activo->id . '|max:50',
            'descrip' => 'required',
            'precio' => 'required|numeric|min:0',
            'fecha' => 'required|date',
            'estado' => 'required|in:activo,inactivo,mantenimiento,baja',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'grupos_id' => 'required|exists:grupos,id',
            'oficinas_id' => 'required|exists:oficinas,id',
            'responsables_id' => 'required|exists:responsables,id',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            // Eliminar foto anterior si existe
            if ($activo->foto && Storage::disk('public')->exists($activo->foto)) {
                Storage::disk('public')->delete($activo->foto);
            }

            $data['foto'] = $request->file('foto')->store('activos', 'public');
        }

        $activo->update($data);

        return redirect()->route('activos.index')
            ->with('success', 'Activo actualizado exitosamente.');
    }

    public function destroy(Activo $activo)
    {
        // Eliminar foto si existe
        if ($activo->foto && Storage::disk('public')->exists($activo->foto)) {
            Storage::disk('public')->delete($activo->foto);
        }

        $activo->delete();
        return redirect()->route('activos.index')
            ->with('success', 'Activo eliminado exitosamente.');
    }
}
