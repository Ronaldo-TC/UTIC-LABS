<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use App\Models\Grupo;
use App\Models\Oficina;
use App\Models\Responsable;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'activos' => Activo::count(),
            'responsables' => Responsable::count(),
            'oficinas' => Oficina::count(),
            'grupos' => Grupo::count(),
            'activos_activos' => Activo::where('estado', 'activo')->count(),
            'valor_total' => Activo::sum('precio'),
        ];

        $ultimos_activos = Activo::with(['responsable', 'oficina'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('home', compact('stats', 'ultimos_activos'));
    }
}
