<?php

namespace App\Http\Controllers;

use App\Models\DetalleComanda;
use App\Models\User;
use App\Models\Comanda;
use App\Models\Cliente;
use App\Models\Plato;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('reporte.pdf')->only(['reporte.pdf']);
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
            $data  = Comanda::join('users as u', 'u.id', 'comandas.user_id')
                ->select('comandas.*', 'u.name as user')
                ->whereBetween('comandas.fecha_venta', [$from, $to])
                ->get();
            $tipoclientes = Cliente::select('*')
                ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
                ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
                ->get();
            $detallecomandas = Comanda::select('*')
            ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
            ->join('platos','platos.id','=','detalle_comandas.plato_id')
            ->get();
                
        } else {
            $data  = Comanda::join('users as u', 'u.id', 'comandas.user_id')
                ->select('comandas.*', 'u.name as user')
                ->whereBetween('comandas.fecha_venta', [$from, $to])
                ->where('user_id', $userId)
                ->get();
            $tipoclientes = Cliente::select('*')
                ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
                ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
                ->get();  
            $detallecomandas = Comanda::select('*')
                ->join('detalle_comandas', 'comandas.id', '=', 'detalle_comandas.comanda_id')
                ->join('platos','platos.id','=','detalle_comandas.plato_id')
                ->get();  
        }
        $user = $userId == 0 ? 'Todos' : User::find($userId)->name;
       
        $pdf = PDF::loadView('admin.report.pdf', compact('detallecomandas','tipoclientes','data', 'tipoReporte', 'user', 'desde', 'hasta'));
        return $pdf->stream('Reporte_de_venta.pdf');
        //return response()->json($detallecomandas);
    }
}
