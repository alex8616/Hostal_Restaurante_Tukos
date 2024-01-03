<?php

namespace App\Exports;

use App\Models\ArticuloCaja;
use App\Models\CodigoCaja;
use App\Models\DetalleCaja;
use App\Models\FacturaVenta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Caja;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\withHeadings;
use PhpParser\Node\Expr\Cast\String_;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FacturaExport implements FromQuery, ShouldAutoSize, withHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(String $datafactura, String $tipoReportefactura, String $user,String $hastafact, String $desdefact, String $estadofactura) {
    //$datafactura,$tipoReportefactura,$user,$hastafact,$desdefact
         $this->datafactura = $datafactura;
         $this->tipoReportefactura = $tipoReportefactura;
         $this->user = $user;
         $this->desdefact = $desdefact;
         $this->hastafact = $hastafact;
         $this->estadofactura = $estadofactura;
    }
    public function headings(): array{
        return [
            [
            'Nro FACTURA',
            'CODIGO DE CONTROL',
            'CI / NIT',
            'NOMBRE',
            'FECHA DE EMISION',
            'IMPORTE',
            'ESTADO',
            'AUTORIZACION',
            ], 
        ];
    }
    public function query()
    {
        if($this->estadofactura == 0){
            return FacturaVenta::select('factura_ventas.numFactura','factura_ventas.codigo_Control','cl.Nit_cliente',
                                    DB::raw("CONCAT(Nombre_cliente,' ',Apellidop_cliente) as value"),
                                    'factura_ventas.fecha_Emision','c.total','factura_ventas.estado',
                                    'cv.autorizacion')
                ->join('comandas as c','c.id','factura_ventas.comanda_id')
                ->join('clientes as cl','cl.id','c.cliente_id')
                ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
                ->whereDate('fecha_Emision','>=',$this->desdefact)->whereDate('fecha_Emision','<=',$this->hastafact);
        }
        if($this->estadofactura == 1){
            return FacturaVenta::select('factura_ventas.numFactura','factura_ventas.codigo_Control','cl.Nit_cliente',
                                    DB::raw("CONCAT(Nombre_cliente,' ',Apellidop_cliente) as value"),
                                    'factura_ventas.fecha_Emision','c.total','factura_ventas.estado',
                                    'cv.autorizacion')
                ->join('comandas as c','c.id','factura_ventas.comanda_id')
                ->join('clientes as cl','cl.id','c.cliente_id')
                ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
                ->where('factura_ventas.estado', 'VALIDO')
                ->whereDate('fecha_Emision','>=',$this->desdefact)->whereDate('fecha_Emision','<=',$this->hastafact);
        }
        if($this->estadofactura == 2){
            return FacturaVenta::select('factura_ventas.numFactura','factura_ventas.codigo_Control','cl.Nit_cliente',
                                    DB::raw("CONCAT(Nombre_cliente,' ',Apellidop_cliente) as value"),
                                    'factura_ventas.fecha_Emision','c.total','factura_ventas.estado',
                                    'cv.autorizacion')
                ->join('comandas as c','c.id','factura_ventas.comanda_id')
                ->join('clientes as cl','cl.id','c.cliente_id')
                ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
                ->where('factura_ventas.estado', 'CANCELADO')
                ->whereDate('fecha_Emision','>=',$this->desdefact)->whereDate('fecha_Emision','<=',$this->hastafact);
        }
        //dd($this->estadofactura);
        //dd($this->desdefact,$this->hastafact); whereBetween('reservation_from', [$from, $to])->get();
        //return FacturaVenta::whereBetween('fecha_Emision', [$this->desdefact,$this->hastafact])->get();   
        /* return FacturaVenta::select('factura_ventas.numFactura','factura_ventas.codigo_Control','cl.Nit_cliente',
                                    DB::raw("CONCAT(Nombre_cliente,' ',Apellidop_cliente,' ',) as value"),
                                    'factura_ventas.fecha_Emision','c.total','factura_ventas.estado',
                                    'cv.autorizacion')
                ->join('comandas as c','c.id','factura_ventas.comanda_id')
                ->join('clientes as cl','cl.id','c.cliente_id')
                ->join('codigo_ventas as cv','cv.id','factura_ventas.codigo_venta_id')
                ->whereDate('fecha_Emision','>=',$this->desdefact)->whereDate('fecha_Emision','<=',$this->hastafact);
 */
    }          
}