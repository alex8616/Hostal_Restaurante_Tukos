<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\ComandaMesa;
use Carbon\Carbon;

class ReporteMesaController extends Component
{
    public $nombreComponenteventa, $dataventa, $tipoReporteventa, $userIdventa, $desdeventa, $hastaventa;
    public function mount()
    {
        $this->nombreComponenteventa = 'Reportes de Mesa';
        $this->dataventa = [];
        $this->tipoReporteventa = 0;
        $this->userIdventa = 0;
    }

    public function render()
    {
        $this->VentasPorFechaMesa();
        return view('livewire.reports.ComponetMesa', [
            'users' => User::OrderBy('name', 'ASC')->get()
        ])->extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
            ->section('content');
    }

    public function VentasPorFechaMesa()
    {
        if ($this->tipoReporteventa == 0) {
            $fromventa = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $toventa = Carbon::parse(Carbon::now())->format('Y-m-d')   . ' 23:59:59';
        } else {
            $fromventa = Carbon::parse($this->desdeventa)->format('Y-m-d') . ' 00:00:00';
            $toventa = Carbon::parse($this->hastaventa)->format('Y-m-d')   . ' 23:59:59';
        }

        if ($this->tipoReporteventa == 1 && ($this->desdeventa == '' || $this->hastaventa == '')) {
            $this->dataventa = ComandaMesa::join('users as u', 'u.id', 'comanda_mesas.user_id')
                ->select('comanda_mesas.*', 'u.name as user')
                ->whereBetween('comanda_mesas.fecha_venta', [$fromventa, $toventa])
                ->get();
            return $this->dataventa;
        }
        if ($this->userIdventa == 0) {
            $this->dataventa = ComandaMesa::join('users as u', 'u.id', 'comanda_mesas.user_id')
                ->select('comanda_mesas.*', 'u.name as user')
                ->whereBetween('comanda_mesas.fecha_venta', [$fromventa, $toventa])
                ->get();
        } else {
            $this->dataventa  = ComandaMesa::join('users as u', 'u.id', 'comanda_mesas.user_id')
                ->select('comanda_mesas.*', 'u.name as user')
                ->whereBetween('comanda_mesas.fecha_venta', [$fromventa, $toventa])
                ->where('user_id', $this->userIdventa)
                ->get();
        }
    }
}