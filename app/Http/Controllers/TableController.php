<?php

namespace App\Http\Controllers;
use App\Models\Caja;
use App\Http\Controllers\Controller;
use App\Models\ArticuloCaja;
use App\Models\CodigoCaja;
use App\Models\DetalleCaja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CajaExport;

class TableController extends Controller
{
    public function datoshostal(Caja $caja,Request $request){
        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();

        $detallecajas = DetalleCaja::select('detalle_cajas.id','detalle_cajas.caja_id','detalle_cajas.codigo_caja_id','detalle_cajas.articulo_caja_id','detalle_cajas.Articulo_description',
        'detalle_cajas.Ingreso','detalle_cajas.Egreso','detalle_cajas.Fecha_registro','detalle_cajas.Factura','detalle_cajas.created_at','detalle_cajas.updated_at',
        'articulo_cajas.Nombre_Articulo','articulo_cajas.Codigo_caja','user_id','cajas.fecha_registro','codigo_cajas.Nombre')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)->get();

        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->sum('Egreso');
        $total = ($detalleIngreso)-$detalleEgreso;

        $iniciohostal = DetalleCaja::select('detalle_cajas.Ingreso')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('articulo_caja_id', '=', 37)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('detalle_cajas.Ingreso');

        //return response()->json($detallecajas);
        //return view('admin.caja.registrar',compact('detallecajas','caja','codigos','articulos','detalleIngreso','detalleEgreso','total','iniciohostal'));
        return datatables()->of($detallecajas)->toJson();

    }
}
