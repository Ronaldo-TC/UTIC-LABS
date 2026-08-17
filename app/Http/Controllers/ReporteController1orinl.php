<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activo;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReporteController extends Controller
{
    public function activosPDF()
    {
        $activos = Activo::with(['responsable', 'grupo', 'oficina'])->get();

        $pdf = Pdf::loadView('reportes.activos-pdf', compact('activos'));

        return $pdf->download('reporte-activos-' . date('Y-m-d') . '.pdf');
    }

    public function activosQR()
    {
        $activos = Activo::with('responsable')->get();

        // Generar QR para cada activo
        foreach ($activos as $activo) {
            $qrData = "Código: {$activo->codigo}\n";
            $qrData .= "Descripción: {$activo->descrip}\n";
            $qrData .= "Responsable: {$activo->responsable->nombre}\n";
            $qrData .= "Fecha: " . $activo->fecha->format('d/m/Y');

            $activo->qr_code = QrCode::size(150)
                ->backgroundColor(255, 255, 255)
                ->color(0, 0, 0)
                ->margin(1)
                ->generate($qrData);
        }

        return view('reportes.activos-qr', compact('activos'));
    }
}
