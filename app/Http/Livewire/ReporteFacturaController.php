<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Comanda;
use App\Models\FacturaVenta;
use Carbon\Carbon;

class ReporteFacturaController extends Component
{
    public $nombreComponente, $datafactura, $tipoReportefactura, $userId, $desdefact, $hastafact;
    public function mount()
    {
        $this->nombreComponente = 'Reporte Factura';
        $this->datafactura = [];
        $this->tipoReportefactura = 0;
        $this->estadofactura = 0;
        $this->userId = 0;
    }

    public function render()
    {
        $this->VentasPorFecha();
        return view('livewire.reports.reporteFactura', [
            'users' => User::OrderBy('name', 'ASC')->get(),
            'factura_ventas' => FacturaVenta::OrderBy('QR', 'ASC')->get()
        ])->extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])   
            ->section('content');
    }

    public function VentasPorFecha()
    {
        if ($this->tipoReportefactura == 0) {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d')   . ' 23:59:59';
        } else {
            $from = Carbon::parse($this->desdefact)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->hastafact)->format('Y-m-d')   . ' 23:59:59';
        }

        if ($this->tipoReportefactura == 1 && ($this->desdefact == '' || $this->hastafact == '')) {
            $this->datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
                ->join('clientes as c', 'c.id','comandas.cliente_id')
                ->join('users as u', 'u.id', 'comandas.user_id')
                ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
                ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                        'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                        'c.Apellidop_cliente as Apellidop_cliente',
                        'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
                ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
                ->get();
            return $this->datafactura;
        }
        if ($this->userId == 0 && $this->estadofactura == 1) {
            $this->datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
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
        }elseif($this->userId == 0 && $this->estadofactura == 2){
            $this->datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
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
        }else {
            $this->datafactura = FacturaVenta::join('comandas', 'comandas.id', 'factura_ventas.comanda_id')
                ->join('clientes as c', 'c.id','comandas.cliente_id')
                ->join('users as u', 'u.id', 'comandas.user_id')
                ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
                ->select('factura_ventas.*','factura_ventas.fecha_Emision as fecha_Emision', 
                        'u.name as user', 'c.Nit_cliente as Nit_cliente', 'c.Nombre_cliente as Nombre_cliente',
                        'c.Apellidop_cliente as Apellidop_cliente',
                        'factura_ventas.estado as estado','cv.autorizacion as autorizacion','comandas.total as total')
                ->whereBetween('factura_ventas.fecha_Emision', [$from, $to])
                ->get();
        }
    }
}