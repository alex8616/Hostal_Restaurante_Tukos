<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleComandaMesa;
use App\Models\User;
use App\Models\ComandaMesa;
use App\Models\FacturaVenta;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FacturaExport;

class ReportFacturaController extends Controller
{
   public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('reporte.pdfmesa')->only(['reporte.pdfmesa']);
    }


    public function reporteEXCEL($userId, $tipoReportefactura, $estadofactura, $desdefact = null, $hastafact = null)
    {
        $datafactura = [];
        if ($userId == 0 && $tipoReportefactura == 0 && $estadofactura == 0) {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d')   . ' 23:59:59';
        } else{
            $from = Carbon::parse($desdefact)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($hastafact)->format('Y-m-d')   . ' 23:59:59';
        }

        if ($userId == 0 && $tipoReportefactura == 1 && $estadofactura == 0) {
            $datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
            ->join('clientes as c', 'c.id','comandas.cliente_id')
            ->join('users as u', 'u.id', 'comandas.user_id')
            ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
            ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                    'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                    'c.Apellidop_cliente as Apellidop_cliente',
                    'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
            ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
            ->get();
        }elseif ($userId == 0 && $tipoReportefactura == 1 && $estadofactura == 1) {
            $datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
            ->join('clientes as c', 'c.id','comandas.cliente_id')
            ->join('users as u', 'u.id', 'comandas.user_id')
            ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
            ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                    'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                    'c.Apellidop_cliente as Apellidop_cliente',
                    'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
            ->where('factura_ventas.estado', 'VALIDO')
            ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
            ->get();
        } elseif($userId == 0 && $tipoReportefactura == 1 && $estadofactura == 2) {
            $datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
            ->join('clientes as c', 'c.id','comandas.cliente_id')
            ->join('users as u', 'u.id', 'comandas.user_id')
            ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
            ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                    'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                    'c.Apellidop_cliente as Apellidop_cliente',
                    'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
            ->where('factura_ventas.estado', 'CANCELADO')
            ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
            ->get();
        }
        if ($userId == 0 && $tipoReportefactura == 0 && $estadofactura == 0) {
            $datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
            ->join('clientes as c', 'c.id','comandas.cliente_id')
            ->join('users as u', 'u.id', 'comandas.user_id')
            ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
            ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                    'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                    'c.Apellidop_cliente as Apellidop_cliente',
                    'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
            ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
            ->get();
        }elseif ($userId == 0 && $tipoReportefactura == 0 && $estadofactura == 1) {
            $datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
            ->join('clientes as c', 'c.id','comandas.cliente_id')
            ->join('users as u', 'u.id', 'comandas.user_id')
            ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
            ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                    'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                    'c.Apellidop_cliente as Apellidop_cliente',
                    'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
            ->where('factura_ventas.estado', 'VALIDO')
            ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
            ->get();
        }elseif ($userId == 0 && $tipoReportefactura == 0 && $estadofactura == 2) {
            $datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
            ->join('clientes as c', 'c.id','comandas.cliente_id')
            ->join('users as u', 'u.id', 'comandas.user_id')
            ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
            ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                    'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                    'c.Apellidop_cliente as Apellidop_cliente',
                    'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
            ->where('factura_ventas.estado', 'CANCELADO')
            ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
            ->get();
        }
        $user = $userId == 0 ? 'Todos' : User::find($userId)->name;

        
        //return response()->json($datafactura);
        return Excel::download(new FacturaExport($datafactura,$tipoReportefactura,$user,$hastafact,$desdefact,$estadofactura), Now().'_Factura.xlsx');

    }
    public function reportePDF($userId, $tipoReportefactura, $estadofactura, $desdefact = null, $hastafact = null)
    {
        $datafactura = [];
        if ($userId == 0 && $tipoReportefactura == 0 && $estadofactura == 0) {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d')   . ' 23:59:59';
        } else{
            $from = Carbon::parse($desdefact)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($hastafact)->format('Y-m-d')   . ' 23:59:59';
        }

        if ($userId == 0 && $tipoReportefactura == 1 && $estadofactura == 0) {
            $datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
            ->join('clientes as c', 'c.id','comandas.cliente_id')
            ->join('users as u', 'u.id', 'comandas.user_id')
            ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
            ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                    'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                    'c.Apellidop_cliente as Apellidop_cliente',
                    'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
            ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
            ->get();
        }elseif ($userId == 0 && $tipoReportefactura == 1 && $estadofactura == 1) {
            $datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
            ->join('clientes as c', 'c.id','comandas.cliente_id')
            ->join('users as u', 'u.id', 'comandas.user_id')
            ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
            ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                    'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                    'c.Apellidop_cliente as Apellidop_cliente',
                    'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
            ->where('factura_ventas.estado', 'VALIDO')
            ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
            ->get();
        } elseif($userId == 0 && $tipoReportefactura == 1 && $estadofactura == 2) {
            $datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
            ->join('clientes as c', 'c.id','comandas.cliente_id')
            ->join('users as u', 'u.id', 'comandas.user_id')
            ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
            ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                    'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                    'c.Apellidop_cliente as Apellidop_cliente',
                    'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
            ->where('factura_ventas.estado', 'CANCELADO')
            ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
            ->get();
        }
        if ($userId == 0 && $tipoReportefactura == 0 && $estadofactura == 0) {
            $datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
            ->join('clientes as c', 'c.id','comandas.cliente_id')
            ->join('users as u', 'u.id', 'comandas.user_id')
            ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
            ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                    'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                    'c.Apellidop_cliente as Apellidop_cliente',
                    'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
            ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
            ->get();
        }elseif ($userId == 0 && $tipoReportefactura == 0 && $estadofactura == 1) {
            $datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
            ->join('clientes as c', 'c.id','comandas.cliente_id')
            ->join('users as u', 'u.id', 'comandas.user_id')
            ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
            ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                    'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                    'c.Apellidop_cliente as Apellidop_cliente',
                    'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
            ->where('factura_ventas.estado', 'VALIDO')
            ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
            ->get();
        }elseif ($userId == 0 && $tipoReportefactura == 0 && $estadofactura == 2) {
            $datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
            ->join('clientes as c', 'c.id','comandas.cliente_id')
            ->join('users as u', 'u.id', 'comandas.user_id')
            ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
            ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                    'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                    'c.Apellidop_cliente as Apellidop_cliente',
                    'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
            ->where('factura_ventas.estado', 'CANCELADO')
            ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
            ->get();
        }
        $user = $userId == 0 ? 'Todos' : User::find($userId)->name;

        $pdf = PDF::loadView('admin.report.factura_pdf', compact('datafactura', 'tipoReportefactura', 'user', 'desdefact', 'hastafact','estadofactura'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Reporte_de_factura.pdf');  
    }
}
