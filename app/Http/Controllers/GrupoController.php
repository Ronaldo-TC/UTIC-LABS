<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = Grupo::withCount('activos')->get();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        return view('grupos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descrip' => 'required|max:100',
            'vidautil' => 'required|integer|min:1|max:50',
        ]);

        Grupo::create($request->all());

        return redirect()->route('grupos.index')
            ->with('success', 'Grupo creado exitosamente.');
    }

    public function show(Grupo $grupo)
    {
        $grupo->loadCount('activos');
        return view('grupos.show', compact('grupo'));
    }

    public function edit(Grupo $grupo)
    {
        return view('grupos.edit', compact('grupo'));
    }

    public function update(Request $request, Grupo $grupo)
    {
        $request->validate([
            'descrip' => 'required|max:100',
            'vidautil' => 'required|integer|min:1|max:50',
        ]);

        $grupo->update($request->all());

        return redirect()->route('grupos.index')
            ->with('success', 'Grupo actualizado exitosamente.');
    }

    public function destroy(Grupo $grupo)
    {
        if ($grupo->activos()->count() > 0) {
            return redirect()->route('grupos.index')
                ->with('error', 'No se puede eliminar el grupo porque tiene activos asociados.');
        }

        $grupo->delete();
        return redirect()->route('grupos.index')
            ->with('success', 'Grupo eliminado exitosamente.');
    }
}
