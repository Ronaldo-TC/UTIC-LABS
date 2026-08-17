<?php

namespace App\Http\Controllers;

use App\Models\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResponsableController extends Controller
{
    public function index()
    {
        $responsables = Responsable::withCount('activos')->get();
        return view('responsables.index', compact('responsables'));
    }

    public function create()
    {
        return view('responsables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ci' => 'required|unique:responsables|max:20',
            'nombre' => 'required|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['ci', 'nombre']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('responsables', 'public');
        }

        Responsable::create($data);

        return redirect()->route('responsables.index')
            ->with('success', 'Responsable creado exitosamente.');
    }

    public function show(Responsable $responsable)
    {
        $responsable->loadCount('activos');
        return view('responsables.show', compact('responsable'));
    }

    public function edit(Responsable $responsable)
    {
        return view('responsables.edit', compact('responsable'));
    }

    public function update(Request $request, Responsable $responsable)
    {
        $request->validate([
            'ci' => 'required|unique:responsables,ci,' . $responsable->id . '|max:20',
            'nombre' => 'required|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['ci', 'nombre']);

        if ($request->hasFile('foto')) {
            // Eliminar foto anterior si existe
            if ($responsable->foto && Storage::disk('public')->exists($responsable->foto)) {
                Storage::disk('public')->delete($responsable->foto);
            }

            $data['foto'] = $request->file('foto')->store('responsables', 'public');
        }

        $responsable->update($data);

        return redirect()->route('responsables.index')
            ->with('success', 'Responsable actualizado exitosamente.');
    }

    public function destroy(Responsable $responsable)
    {
        if ($responsable->activos()->count() > 0) {
            return redirect()->route('responsables.index')
                ->with('error', 'No se puede eliminar el responsable porque tiene activos asignados.');
        }

        // Eliminar foto si existe
        if ($responsable->foto && Storage::disk('public')->exists($responsable->foto)) {
            Storage::disk('public')->delete($responsable->foto);
        }

        $responsable->delete();
        return redirect()->route('responsables.index')
            ->with('success', 'Responsable eliminado exitosamente.');
    }
}
