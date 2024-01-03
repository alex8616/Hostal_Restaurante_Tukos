<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleComandaMesa;
use App\Models\User;
use App\Models\ComandaMesa;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportMesaController extends Controller
{
   public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('reporte.pdfmesa')->only(['reporte.pdfmesa']);
    }


    public function reportePDF($userId, $tipoReporte, $desde = null, $hasta = null)
    {
        $data = [];
        if ($tipoReporte == 0) {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d')   . ' 23:59:59';
        } else {
            $from = Carbon::parse($desde)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($hasta)->format('Y-m-d')   . ' 23:59:59';
        }

        if ($userId == 0) {
            $data = ComandaMesa::join('users as u', 'u.id', 'comanda_mesas.user_id')
                ->select('comanda_mesas.*', 'u.name as user')
                ->whereBetween('comanda_mesas.fecha_venta', [$from, $to])
                ->get();
        } else {
            $data  = ComandaMesa::join('users as u', 'u.id', 'comanda_mesas.user_id')
                ->select('comanda_mesas.*', 'u.name as user')
                ->whereBetween('comanda_mesas.fecha_venta', [$from, $to])
                ->where('user_id', $userId)
                ->get();
        }
        $user = $userId == 0 ? 'Todos' : User::find($userId)->name;

        $pdf = PDF::loadView('admin.report.pdfmesa', compact('data', 'tipoReporte', 'user', 'desde', 'hasta'));
        return $pdf->stream('Reporte_de_venta.pdf');
    }
}
