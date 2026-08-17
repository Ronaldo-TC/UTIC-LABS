<?php

namespace App\Http\Controllers;

use App\Models\Oficina;
use Illuminate\Http\Request;

class OficinaController extends Controller
{
    public function index()
    {
        $oficinas = Oficina::withCount('activos')->get();
        return view('oficinas.index', compact('oficinas'));
    }

    public function create()
    {
        return view('oficinas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100',
        ]);

        Oficina::create($request->all());

        return redirect()->route('oficinas.index')
            ->with('success', 'Oficina creada exitosamente.');
    }

    public function show(Oficina $oficina)
    {
        $oficina->loadCount('activos');
        return view('oficinas.show', compact('oficina'));
    }

    public function edit(Oficina $oficina)
    {
        return view('oficinas.edit', compact('oficina'));
    }

    public function update(Request $request, Oficina $oficina)
    {
        $request->validate([
            'nombre' => 'required|max:100',
        ]);

        $oficina->update($request->all());

        return redirect()->route('oficinas.index')
            ->with('success', 'Oficina actualizada exitosamente.');
    }

    public function destroy(Oficina $oficina)
    {
        if ($oficina->activos()->count() > 0) {
            return redirect()->route('oficinas.index')
                ->with('error', 'No se puede eliminar la oficina porque tiene activos asociados.');
        }

        $oficina->delete();
        return redirect()->route('oficinas.index')
            ->with('success', 'Oficina eliminada exitosamente.');
    }
}
