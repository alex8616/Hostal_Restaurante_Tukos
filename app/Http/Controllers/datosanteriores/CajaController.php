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
use Illuminate\Support\Facades\Route;
use DateTime;

class CajaController extends Controller
{

    public function index(){
        $cajas = Caja::orderBy('id', 'desc')->get();
        return view('admin.caja.index',compact('cajas'));
    }

    //Hostal json
    public function data(Caja $caja){
        $detallecajas = DetalleCaja::select('detalle_cajas.id','detalle_cajas.caja_id','detalle_cajas.codigo_caja_id','detalle_cajas.articulo_caja_id','detalle_cajas.Articulo_description',
        'detalle_cajas.Ingreso','detalle_cajas.Egreso','detalle_cajas.Fecha_registro','detalle_cajas.Factura','detalle_cajas.created_at','detalle_cajas.updated_at',
        'articulo_cajas.Nombre_Articulo','articulo_cajas.Codigo_caja','user_id','cajas.fecha_registro','codigo_cajas.Nombre','detalle_cajas.Deuda')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->orderBy('detalle_cajas.Fecha_registro','ASC')
        ->get();
        
        $sum = 0;
        $i = 0;
        foreach($detallecajas as $item){
            if($item->Deuda == 'NO'){
                $sum += $item->Ingreso - $item->Egreso;
                $item->sum = number_format($sum, 2, '.', '');
                $i++;
                $item->cont = $i;
            }else{
                if($i == 0){
                    $sum = 0;
                }
            }
        }
        return datatables()->of($detallecajas)->toJson(); 
    }

    //actializar estado
    public function actualizarEstado(Request $request){
        $id = $request->input('id');
        $nuevoEstado = $request->input('nuevoEstado');
        
        $detalleCaja = DetalleCaja::find($id);
        $detalleCaja->Deuda = $nuevoEstado;
        $detalleCaja->save();

        if($nuevoEstado == 'SI'){
            $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 2)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Ingreso');
            $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 2)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Egreso');
            $resultadohostal = $hostal_ingreso-$hostal_egreso;

            $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 1)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Ingreso');
            $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 1)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Egreso');
            $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;
            
            $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
            $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');
            
            $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;

            $cajas = Caja:: findOrFail($detalleCaja->caja_id);
            $cajas->caja_hostal_ingreso = $hostal_ingreso;
            $cajas->caja_hostal_egreso = $hostal_egreso;
            $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
            $cajas->caja_restaurante_egreso = $restaurante_egreso;
            $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
            $cajas->total = $totalfinal;
            $cajas->caja_depositos_ingreso = $depositos_ingreso;
            $cajas->save();

            $cajagrande = DetalleCaja::select('Ingreso')
            ->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
            ->where('detalle_cajas.codigo_caja_id', '=', 2)
            ->where('detalle_cajas.articulo_caja_id', '=', 29)
            ->sum('Ingreso');
            $detalleIngreso = DetalleCaja::select('Ingreso')
            ->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
            ->where('detalle_cajas.codigo_caja_id', '=', 2)
            ->where('detalle_cajas.Deuda', '=', 'NO')
            ->sum('Ingreso');
            $detalleEgreso = DetalleCaja::select('Egreso')
            ->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
            ->where('detalle_cajas.codigo_caja_id', '=', 2)
            ->where('detalle_cajas.Deuda', '=', 'NO')
            ->sum('Egreso');
            $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

            $totals = [
                'cajagrande' => $cajagrande,
                'detalleIngreso' => $detalleIngreso,
                'detalleEgreso' => $detalleEgreso,
                'total' => $total,
            ];
            
            return response()->json([
                'totals' => $totals
            ]);
        }else{
            $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 2)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Ingreso');
            $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 2)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Egreso');
            $resultadohostal = $hostal_ingreso-$hostal_egreso;

            $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 1)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Ingreso');
            $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 1)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Egreso');
            $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;
            
            $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
            $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');
            
            $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;

            $cajas = Caja:: findOrFail($detalleCaja->caja_id);
            $cajas->caja_hostal_ingreso = $hostal_ingreso;
            $cajas->caja_hostal_egreso = $hostal_egreso;
            $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
            $cajas->caja_restaurante_egreso = $restaurante_egreso;
            $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
            $cajas->total = $totalfinal;
            $cajas->caja_depositos_ingreso = $depositos_ingreso;
            $cajas->save();

            $cajagrande = DetalleCaja::select('Ingreso')
            ->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
            ->where('detalle_cajas.codigo_caja_id', '=', 2)
            ->where('detalle_cajas.articulo_caja_id', '=', 29)
            ->sum('Ingreso');
            $detalleIngreso = DetalleCaja::select('Ingreso')
            ->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
            ->where('detalle_cajas.codigo_caja_id', '=', 2)
            ->where('detalle_cajas.Deuda', '=', 'NO')
            ->sum('Ingreso');
            $detalleEgreso = DetalleCaja::select('Egreso')
            ->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
            ->where('detalle_cajas.codigo_caja_id', '=', 2)
            ->where('detalle_cajas.Deuda', '=', 'NO')
            ->sum('Egreso');
            $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

            $totals = [
                'cajagrande' => $cajagrande,
                'detalleIngreso' => $detalleIngreso,
                'detalleEgreso' => $detalleEgreso,
                'total' => $total,
            ];
            
            return response()->json([
                'totals' => $totals
            ]);
        }
    }

    //actializar estado restaurante Deuda
    public function actualizarEstadoRestaurante(Request $request){
        $id = $request->input('id');
        $nuevoEstado = $request->input('nuevoEstado');
        
        $detalleCaja = DetalleCaja::find($id);
        $detalleCaja->Deuda = $nuevoEstado;
        $detalleCaja->save();

        if($nuevoEstado == 'SI'){
            $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 2)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Ingreso');
            $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 2)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Egreso');
            $resultadohostal = $hostal_ingreso-$hostal_egreso;

            $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 1)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Ingreso');
            $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 1)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Egreso');
            $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;
            
            $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
            $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');
            
            $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;

            $cajas = Caja:: findOrFail($detalleCaja->caja_id);
            $cajas->caja_hostal_ingreso = $hostal_ingreso;
            $cajas->caja_hostal_egreso = $hostal_egreso;
            $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
            $cajas->caja_restaurante_egreso = $restaurante_egreso;
            $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
            $cajas->total = $totalfinal;
            $cajas->caja_depositos_ingreso = $depositos_ingreso;
            $cajas->save();

            $cajagrande = DetalleCaja::select('Ingreso')
            ->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
            ->where('detalle_cajas.codigo_caja_id', '=', 1)
            ->where('detalle_cajas.articulo_caja_id', '=', 29)
            ->sum('Ingreso');
            $detalleIngreso = DetalleCaja::select('Ingreso')
            ->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
            ->where('detalle_cajas.codigo_caja_id', '=', 1)
            ->where('detalle_cajas.Deuda', '=', 'NO')
            ->sum('Ingreso');
            $detalleEgreso = DetalleCaja::select('Egreso')
            ->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
            ->where('detalle_cajas.codigo_caja_id', '=', 1)
            ->where('detalle_cajas.Deuda', '=', 'NO')
            ->sum('Egreso');
            $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

            $totals = [
                'cajagrande' => $cajagrande,
                'detalleIngreso' => $detalleIngreso,
                'detalleEgreso' => $detalleEgreso,
                'total' => $total,
            ];
            
            return response()->json([
                'totals' => $totals
            ]);
        }else{
            $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 2)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Ingreso');
            $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 2)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Egreso');
            $resultadohostal = $hostal_ingreso-$hostal_egreso;

            $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 1)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Ingreso');
            $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
                                        ->where('detalle_cajas.codigo_caja_id', '=', 1)
                                        ->where('detalle_cajas.Deuda', '=', 'NO')
                                        ->sum('Egreso');
            $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;
            
            $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
            $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');
            
            $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;

            $cajas = Caja:: findOrFail($detalleCaja->caja_id);
            $cajas->caja_hostal_ingreso = $hostal_ingreso;
            $cajas->caja_hostal_egreso = $hostal_egreso;
            $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
            $cajas->caja_restaurante_egreso = $restaurante_egreso;
            $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
            $cajas->total = $totalfinal;
            $cajas->caja_depositos_ingreso = $depositos_ingreso;
            $cajas->save();

            $cajagrande = DetalleCaja::select('Ingreso')
            ->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
            ->where('detalle_cajas.codigo_caja_id', '=', 1)
            ->where('detalle_cajas.articulo_caja_id', '=', 29)
            ->sum('Ingreso');
            $detalleIngreso = DetalleCaja::select('Ingreso')
            ->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
            ->where('detalle_cajas.codigo_caja_id', '=', 1)
            ->where('detalle_cajas.Deuda', '=', 'NO')
            ->sum('Ingreso');
            $detalleEgreso = DetalleCaja::select('Egreso')
            ->where('detalle_cajas.caja_id', '=', $detalleCaja->caja_id)
            ->where('detalle_cajas.codigo_caja_id', '=', 1)
            ->where('detalle_cajas.Deuda', '=', 'NO')
            ->sum('Egreso');
            $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

            $totals = [
                'cajagrande' => $cajagrande,
                'detalleIngreso' => $detalleIngreso,
                'detalleEgreso' => $detalleEgreso,
                'total' => $total,
            ];
            
            return response()->json([
                'totals' => $totals
            ]);
        }
    }

    //Restaurante json
    public function datarestaurante(Caja $caja){
        $detallecajas = DetalleCaja::select('detalle_cajas.id','detalle_cajas.caja_id','detalle_cajas.codigo_caja_id','detalle_cajas.articulo_caja_id','detalle_cajas.Articulo_description',
        'detalle_cajas.Ingreso','detalle_cajas.Egreso','detalle_cajas.Fecha_registro','detalle_cajas.Factura','detalle_cajas.created_at','detalle_cajas.updated_at',
        'articulo_cajas.Nombre_Articulo','articulo_cajas.Codigo_caja','user_id','cajas.fecha_registro','codigo_cajas.Nombre','detalle_cajas.Deuda')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->orderBy('detalle_cajas.Fecha_registro','ASC')
        ->get();

        $sum = 0;
        $i = 0;
        foreach($detallecajas as $item){
            if($item->Deuda == 'NO'){
                $sum += $item->Ingreso - $item->Egreso;
                $item->sum = number_format($sum, 2, '.', '');
                $i++;
                $item->cont = $i;
            }else{
                if($i == 0){
                    $sum = 0;
                }
            }
        }
        return datatables()->of($detallecajas)->toJson();  
    }

    //Tarjetas json
    public function datatarjetas(Caja $caja){
        $detallecajas = DetalleCaja::select('detalle_cajas.id','detalle_cajas.caja_id','detalle_cajas.codigo_caja_id','detalle_cajas.articulo_caja_id','detalle_cajas.Articulo_description',
        'detalle_cajas.Ingreso','detalle_cajas.Egreso','detalle_cajas.Fecha_registro','detalle_cajas.Factura','detalle_cajas.created_at','detalle_cajas.updated_at',
        'articulo_cajas.Nombre_Articulo','articulo_cajas.Codigo_caja','user_id','cajas.fecha_registro','codigo_cajas.Nombre')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->get();

        $sum = 0;
        $i = 0;
        foreach($detallecajas as $item){
            $sum += $item->Ingreso - $item->Egreso;
            $i++;
            $item->sum = number_format($sum, 2, '.', '');
            $item->cont = $i;
        }
        return datatables()->of($detallecajas)->toJson(); 
    }

    //Tarjetas json
    public function datadepositos(Caja $caja){
        $detallecajas = DetalleCaja::select('detalle_cajas.id','detalle_cajas.caja_id','detalle_cajas.codigo_caja_id','detalle_cajas.articulo_caja_id','detalle_cajas.Articulo_description',
        'detalle_cajas.Ingreso','detalle_cajas.Egreso','detalle_cajas.Fecha_registro','detalle_cajas.Factura','detalle_cajas.created_at','detalle_cajas.updated_at',
        'articulo_cajas.Nombre_Articulo','articulo_cajas.Codigo_caja','user_id','cajas.fecha_registro','codigo_cajas.Nombre')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->get();

        $sum = 0;
        $i = 0;
        foreach($detallecajas as $item){
            $sum += $item->Ingreso - $item->Egreso;
            $i++;
            $item->sum = number_format($sum, 2, '.', '');
            $item->cont = $i;
        }
        return datatables()->of($detallecajas)->toJson(); 
    }

    public function edit($id){
        $detallecaja = DetalleCaja::findOrFail($id);
        return response()->json($detallecaja);
    }

    ///funcion para actualizar hostal detalle caja
    public function update(Request $request, $id){        
        $DatosDetalle = DetalleCaja:: findOrFail($id); 
        $DatosDetalle->caja_id = $request->caja_id;
        $DatosDetalle->Articulo_description = $request->Articulo_description;
        $DatosDetalle->Factura = $request->Factura;
        $DatosDetalle->Ingreso = $request->Ingreso;
        $DatosDetalle->Egreso = $request->Egreso;
        $DatosDetalle->articulo_caja_id = $request->articulo_caja_id;        
        $DatosDetalle->Fecha_registro = $request->Fecha_registro;
        if($request->Factura == 'Con_Factura'){
            $DatosDetalle->Factura = $request->Factura;
            $DatosDetalle->NFactura = $request->NFactura;
        }else{
            $DatosDetalle->Factura = $request->Factura;
            $DatosDetalle->NFactura = NULL;
        }
        $DatosDetalle->save();
        
        $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
        $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
        $resultadohostal = $hostal_ingreso-$hostal_egreso;

        $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
        $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
        $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;

        $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
        $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');
        
        $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
        
        $cajas = Caja:: findOrFail($request->caja_id);
        $cajas->caja_hostal_ingreso = $hostal_ingreso;
        $cajas->caja_hostal_egreso = $hostal_egreso;
        $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
        $cajas->caja_restaurante_egreso = $restaurante_egreso;
        $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
        $cajas->total = $totalfinal;
        $cajas->caja_depositos_ingreso = $depositos_ingreso;
        $cajas->save();
        
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $totals = [
            'cajagrande' => $cajagrande,
            'detalleIngreso' => $detalleIngreso,
            'detalleEgreso' => $detalleEgreso,
            'total' => $total,
        ];
        
        return response()->json([
            'DatosDetalle' => $DatosDetalle, // Cambiado de 'detalle' a 'DatosDetalle'
            'totals' => $totals,
        ]);       
    }

    ///funcion para actualizar restaurante detalle caja
    public function updateRestaurante(Request $request, $id){        
        $DatosDetalle = DetalleCaja:: findOrFail($id); 
        $DatosDetalle->caja_id = $request->caja_id;
        $DatosDetalle->Articulo_description = $request->Articulo_description;
        $DatosDetalle->Factura = $request->Factura;
        $DatosDetalle->Ingreso = $request->Ingreso;
        $DatosDetalle->Egreso = $request->Egreso;
        $DatosDetalle->articulo_caja_id = $request->articulo_caja_id;        
        $DatosDetalle->Fecha_registro = $request->Fecha_registro;
        if($request->Factura == 'Con_Factura'){
            $DatosDetalle->Factura = $request->Factura;
            $DatosDetalle->NFactura = $request->NFactura;
        }else{
            $DatosDetalle->Factura = $request->Factura;
            $DatosDetalle->NFactura = NULL;
        }
        $DatosDetalle->save();
        
        $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
        $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
        $resultadohostal = $hostal_ingreso-$hostal_egreso;

        $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
        $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
        $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;

        $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
        $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');
        
        $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
        
        $cajas = Caja:: findOrFail($request->caja_id);
        $cajas->caja_hostal_ingreso = $hostal_ingreso;
        $cajas->caja_hostal_egreso = $hostal_egreso;
        $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
        $cajas->caja_restaurante_egreso = $restaurante_egreso;
        $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
        $cajas->total = $totalfinal;
        $cajas->caja_depositos_ingreso = $depositos_ingreso;
        $cajas->save();
        
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $totals = [
            'cajagrande' => $cajagrande,
            'detalleIngreso' => $detalleIngreso,
            'detalleEgreso' => $detalleEgreso,
            'total' => $total,
        ];
        
        return response()->json([
            'DatosDetalle' => $DatosDetalle, // Cambiado de 'detalle' a 'DatosDetalle'
            'totals' => $totals,
        ]);       
    }

    ///funcion para actualizar tarjetas detalle caja
    public function updateTarjetas(Request $request, $id){        
        $DatosDetalle = DetalleCaja:: findOrFail($id); 
        $DatosDetalle->caja_id = $request->caja_id;
        $DatosDetalle->Articulo_description = $request->Articulo_description;
        $DatosDetalle->Factura = $request->Factura;
        $DatosDetalle->Ingreso = $request->Ingreso;
        $DatosDetalle->Egreso = $request->Egreso;
        $DatosDetalle->articulo_caja_id = $request->articulo_caja_id;        
        $DatosDetalle->Fecha_registro = $request->Fecha_registro;
        if($request->Factura == 'Con_Factura'){
            $DatosDetalle->Factura = $request->Factura;
            $DatosDetalle->NFactura = $request->NFactura;
        }else{
            $DatosDetalle->Factura = $request->Factura;
            $DatosDetalle->NFactura = NULL;
        }
        $DatosDetalle->save();
        
        $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
        $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
        $resultadohostal = $hostal_ingreso-$hostal_egreso;

        $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
        $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
        $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;

        $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
        $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');
        
        $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
        
        $cajas = Caja:: findOrFail($request->caja_id);
        $cajas->caja_hostal_ingreso = $hostal_ingreso;
        $cajas->caja_hostal_egreso = $hostal_egreso;
        $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
        $cajas->caja_restaurante_egreso = $restaurante_egreso;
        $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
        $cajas->total = $totalfinal;
        $cajas->caja_depositos_ingreso = $depositos_ingreso;
        $cajas->save();
        
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $totals = [
            'cajagrande' => $cajagrande,
            'detalleIngreso' => $detalleIngreso,
            'detalleEgreso' => $detalleEgreso,
            'total' => $total,
        ];
        
        return response()->json([
            'DatosDetalle' => $DatosDetalle, // Cambiado de 'detalle' a 'DatosDetalle'
            'totals' => $totals,
        ]);       
    }

    ///funcion para actualizar depositos detalle caja
    public function updateDepositos(Request $request, $id){        
        $DatosDetalle = DetalleCaja:: findOrFail($id); 
        $DatosDetalle->caja_id = $request->caja_id;
        $DatosDetalle->Articulo_description = $request->Articulo_description;
        $DatosDetalle->Factura = $request->Factura;
        $DatosDetalle->Ingreso = $request->Ingreso;
        $DatosDetalle->Egreso = $request->Egreso;
        $DatosDetalle->articulo_caja_id = $request->articulo_caja_id;        
        $DatosDetalle->Fecha_registro = $request->Fecha_registro;
        if($request->Factura == 'Con_Factura'){
            $DatosDetalle->Factura = $request->Factura;
            $DatosDetalle->NFactura = $request->NFactura;
        }else{
            $DatosDetalle->Factura = $request->Factura;
            $DatosDetalle->NFactura = NULL;
        }
        $DatosDetalle->save();
        
        $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
        $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
        $resultadohostal = $hostal_ingreso-$hostal_egreso;

        $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
        $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
        $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;

        $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
        $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');
        
        $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
        
        $cajas = Caja:: findOrFail($request->caja_id);
        $cajas->caja_hostal_ingreso = $hostal_ingreso;
        $cajas->caja_hostal_egreso = $hostal_egreso;
        $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
        $cajas->caja_restaurante_egreso = $restaurante_egreso;
        $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
        $cajas->total = $totalfinal;
        $cajas->caja_depositos_ingreso = $depositos_ingreso;
        $cajas->save();
        
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $totals = [
            'cajagrande' => $cajagrande,
            'detalleIngreso' => $detalleIngreso,
            'detalleEgreso' => $detalleEgreso,
            'total' => $total,
        ];
        
        return response()->json([
            'DatosDetalle' => $DatosDetalle, // Cambiado de 'detalle' a 'DatosDetalle'
            'totals' => $totals,
        ]);       
    }

    public function registrar(Caja $caja,Request $request){
        $currentRoute = Route::currentRouteName();
        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::orderBy('Nombre_Articulo', 'asc')->get();

        $detallecajas = DetalleCaja::select('detalle_cajas.id','detalle_cajas.caja_id','detalle_cajas.codigo_caja_id','detalle_cajas.articulo_caja_id','detalle_cajas.Articulo_description',
        'detalle_cajas.Ingreso','detalle_cajas.Egreso','detalle_cajas.Fecha_registro','detalle_cajas.Factura','detalle_cajas.created_at','detalle_cajas.updated_at',
        'articulo_cajas.Nombre_Articulo','articulo_cajas.Codigo_caja','user_id','cajas.fecha_registro','codigo_cajas.Nombre')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->orderBy('detalle_cajas.id', 'asc')->get();

  
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->where('detalle_cajas.Deuda', '=', 'NO')
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->where('detalle_cajas.Deuda', '=', 'NO')
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $iniciohostal = DetalleCaja::select('detalle_cajas.Ingreso')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('articulo_caja_id', '=', 37)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('detalle_cajas.Ingreso');       
        
        return view('admin.caja.registrar',compact('currentRoute','cajagrande','detallecajas','caja','codigos','articulos','detalleIngreso','detalleEgreso','total','iniciohostal'));

    }

    public function registrar_restaurante(Caja $caja,Request $request){
        $currentRoute = Route::currentRouteName();

        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();

        $detallecajas = DetalleCaja::select('detalle_cajas.id','detalle_cajas.caja_id','detalle_cajas.codigo_caja_id','detalle_cajas.articulo_caja_id','detalle_cajas.Articulo_description',
        'detalle_cajas.Ingreso','detalle_cajas.Egreso','detalle_cajas.Fecha_registro','detalle_cajas.Factura','detalle_cajas.created_at','detalle_cajas.updated_at',
        'articulo_cajas.Nombre_Articulo','articulo_cajas.Codigo_caja','user_id','cajas.fecha_registro','codigo_cajas.Nombre')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)->orderBy('detalle_cajas.id', 'asc')->paginate(10);

        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->where('detalle_cajas.Deuda', '=', 'NO')
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->where('detalle_cajas.Deuda', '=', 'NO')
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $iniciorestaurante = DetalleCaja::select('detalle_cajas.Ingreso')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('articulo_caja_id', '=', 37)
        ->where('detalle_cajas.Deuda', '=', 'NO')
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->sum('detalle_cajas.Ingreso');

        //return response()->json($detalleIngreso);
        return view('admin.caja.registrar_restaurante',compact('currentRoute','cajagrande','detallecajas','caja','codigos','articulos','detalleIngreso','detalleEgreso','total','iniciorestaurante'));
    }

    public function registrar_tarjeta(Caja $caja,Request $request){
        $currentRoute = Route::currentRouteName();
        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();

        $detallecajas = DetalleCaja::select('detalle_cajas.id','detalle_cajas.caja_id','detalle_cajas.codigo_caja_id','detalle_cajas.articulo_caja_id','detalle_cajas.Articulo_description',
        'detalle_cajas.Ingreso','detalle_cajas.Egreso','detalle_cajas.Fecha_registro','detalle_cajas.Factura','detalle_cajas.created_at','detalle_cajas.updated_at',
        'articulo_cajas.Nombre_Articulo','articulo_cajas.Codigo_caja','user_id','cajas.fecha_registro','codigo_cajas.Nombre')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)->orderBy('detalle_cajas.id', 'asc')->paginate(10);

        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;
        
        //return response()->json($detalleEgreso);
        return view('admin.caja.registrar_tarjeta',compact('currentRoute','cajagrande','detallecajas','caja','codigos','articulos','detalleIngreso','detalleEgreso','total'));
    }

    public function registrar_deposito(Caja $caja,Request $request){
        $currentRoute = Route::currentRouteName();
        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();

        $detallecajas = DetalleCaja::select('detalle_cajas.id','detalle_cajas.caja_id','detalle_cajas.codigo_caja_id','detalle_cajas.articulo_caja_id','detalle_cajas.Articulo_description',
        'detalle_cajas.Ingreso','detalle_cajas.Egreso','detalle_cajas.Fecha_registro','detalle_cajas.Factura','detalle_cajas.created_at','detalle_cajas.updated_at',
        'articulo_cajas.Nombre_Articulo','articulo_cajas.Codigo_caja','user_id','cajas.fecha_registro','codigo_cajas.Nombre')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)->orderBy('detalle_cajas.id', 'asc')->paginate(10);

        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;
        
        //return response()->json($detalleEgreso);
        return view('admin.caja.registrar_deposito',compact('currentRoute','cajagrande','detallecajas','caja','codigos','articulos','detalleIngreso','detalleEgreso','total'));
    }
   
    public function codigo(){
        $codigos = CodigoCaja::orderBy('id', 'desc')->get();
        return view('admin.caja.codigo',compact('codigos'));
    }

    public function articulos(){
        $articulos = ArticuloCaja::orderBy('id', 'desc')->get();
        return view('admin.caja.articulos',compact('articulos'));
    }
    
    public function reportescaja(){
        return view('admin.caja.reportescaja');
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $data = request()->validate([
                'fecha_registro' => 'required|unique:cajas',
                ]);

            $datoscaja = Caja::create([
                'fecha_registro' => $data['fecha_registro'],
                'user_id' => Auth::user()->id,
            ]);
            DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ⚡️', 'No Se Pudo Registrar');
                return redirect()->route('admin.caja.index');
            }
                notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente ⚡️', 'Se Registro Correctamente');
                return redirect()->route('admin.caja.index');
    }

    ///crea nuevo detalle caja hostal
    public function storedetallecaja(Request $request){
        $detallecajas = DetalleCaja::create([
            'caja_id' => $request->input('caja_id'),
            'codigo_caja_id' => $request->input('codigo_caja_id'),
            'Articulo_description' => $request->input('Articulo_description'),
            'Factura' => $request->input('Factura'),
            'NFactura' => $request->input('otra_respuesta'),
            'Ingreso' => $request->input('InputIngreso'),
            'Egreso' => $request->input('InputEgreso'),
            'articulo_caja_id' => $request->input('articulo_caja_id'),
            'Fecha_registro' => $request->input('fecha_registro'),
        ]);
        
        $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
        $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
        $resultadohostal = $hostal_ingreso-$hostal_egreso;

        $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
        $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
        $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;
        $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
        $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');

        $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
        
        $cajas = Caja:: findOrFail($request->caja_id);
        $cajas->caja_hostal_ingreso = $hostal_ingreso;
        $cajas->caja_hostal_egreso = $hostal_egreso;
        $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
        $cajas->caja_restaurante_egreso = $restaurante_egreso;
        $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
        $cajas->total = $totalfinal;
        $cajas->caja_depositos_ingreso = $depositos_ingreso;
        $cajas->save();   
        
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $totals = [
            'cajagrande' => $cajagrande,
            'detalleIngreso' => $detalleIngreso,
            'detalleEgreso' => $detalleEgreso,
            'total' => $total,
        ];
        
        return response()->json([
            'totals' => $totals
        ]);
    }

    ///crea nuevo detalle caja restaurante 
    public function storedetallecajaRestaurante(Request $request){
        $detallecajas = DetalleCaja::create([
            'caja_id' => $request->input('caja_id'),
            'codigo_caja_id' => $request->input('codigo_caja_id'),
            'Articulo_description' => $request->input('Articulo_description'),
            'Factura' => $request->input('Factura'),
            'NFactura' => $request->input('otra_respuesta'),
            'Ingreso' => $request->input('InputIngreso'),
            'Egreso' => $request->input('InputEgreso'),
            'articulo_caja_id' => $request->input('articulo_caja_id'),
            'Fecha_registro' => $request->input('fecha_registro'),
        ]);
        
        $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
        $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
        $resultadohostal = $hostal_ingreso-$hostal_egreso;

        $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
        $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
        $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;
        $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
        $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');

        $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
        
        $cajas = Caja:: findOrFail($request->caja_id);
        $cajas->caja_hostal_ingreso = $hostal_ingreso;
        $cajas->caja_hostal_egreso = $hostal_egreso;
        $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
        $cajas->caja_restaurante_egreso = $restaurante_egreso;
        $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
        $cajas->total = $totalfinal;
        $cajas->caja_depositos_ingreso = $depositos_ingreso;
        $cajas->save();   
        
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $totals = [
            'cajagrande' => $cajagrande,
            'detalleIngreso' => $detalleIngreso,
            'detalleEgreso' => $detalleEgreso,
            'total' => $total,
        ];
        
        return response()->json([
            'totals' => $totals
        ]);
    }

    ///crea nuevo detalle caja tarjetas 
    public function storedetallecajaTarjetas(Request $request){
        $detallecajas = DetalleCaja::create([
            'caja_id' => $request->input('caja_id'),
            'codigo_caja_id' => $request->input('codigo_caja_id'),
            'Articulo_description' => $request->input('Articulo_description'),
            'Factura' => $request->input('Factura'),
            'NFactura' => $request->input('otra_respuesta'),
            'Ingreso' => $request->input('InputIngreso'),
            'Egreso' => $request->input('InputEgreso'),
            'articulo_caja_id' => $request->input('articulo_caja_id'),
            'Fecha_registro' => Carbon::now('America/La_Paz')->format('Y-m-d H:i:s'),
        ]);
        
        $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
        $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
        $resultadohostal = $hostal_ingreso-$hostal_egreso;

        $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
        $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
        $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;
        $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
        $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');

        $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
        
        $cajas = Caja:: findOrFail($request->caja_id);
        $cajas->caja_hostal_ingreso = $hostal_ingreso;
        $cajas->caja_hostal_egreso = $hostal_egreso;
        $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
        $cajas->caja_restaurante_egreso = $restaurante_egreso;
        $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
        $cajas->total = $totalfinal;
        $cajas->caja_depositos_ingreso = $depositos_ingreso;
        $cajas->save();   
        
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $totals = [
            'cajagrande' => $cajagrande,
            'detalleIngreso' => $detalleIngreso,
            'detalleEgreso' => $detalleEgreso,
            'total' => $total,
        ];
        
        return response()->json([
            'totals' => $totals
        ]);
    }

    ///crea nuevo detalle caja depositos 
    public function storedetallecajaDepositos(Request $request){
        $detallecajas = DetalleCaja::create([
            'caja_id' => $request->input('caja_id'),
            'codigo_caja_id' => $request->input('codigo_caja_id'),
            'Articulo_description' => $request->input('Articulo_description'),
            'Factura' => $request->input('Factura'),
            'NFactura' => $request->input('otra_respuesta'),
            'Ingreso' => $request->input('InputIngreso'),
            'Egreso' => $request->input('InputEgreso'),
            'articulo_caja_id' => $request->input('articulo_caja_id'),
            'Fecha_registro' => Carbon::now('America/La_Paz')->format('Y-m-d H:i:s'),
        ]);
        
        $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
        $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
        $resultadohostal = $hostal_ingreso-$hostal_egreso;

        $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
        $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
        $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;
        $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
        $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');

        $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
        
        $cajas = Caja:: findOrFail($request->caja_id);
        $cajas->caja_hostal_ingreso = $hostal_ingreso;
        $cajas->caja_hostal_egreso = $hostal_egreso;
        $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
        $cajas->caja_restaurante_egreso = $restaurante_egreso;
        $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
        $cajas->total = $totalfinal;
        $cajas->caja_depositos_ingreso = $depositos_ingreso;
        $cajas->save();   
        
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $request->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $totals = [
            'cajagrande' => $cajagrande,
            'detalleIngreso' => $detalleIngreso,
            'detalleEgreso' => $detalleEgreso,
            'total' => $total,
        ];
        
        return response()->json([
            'totals' => $totals
        ]);
    }

    public function storecodigo(Request $request){
        try {
            DB::beginTransaction();
            $data = request()->validate([
                'Nombre' => 'required|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ]+$/|max:50|unique:codigo_cajas',
               ]);
    
            $codigos = CodigoCaja::create([
                'Nombre' => $data['Nombre'],
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ⚡️', 'No Se Pudo Registrar');
            return back();
        }
            notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente ⚡️', 'Se Registro Correctamente');
            return back();
    }

    public function storearticulo(Request $request){
        try {
            DB::beginTransaction();
            $articulos = ArticuloCaja::create($request->all());
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ⚡️', 'No Se Pudo Registrar');
            return back();
        }
            notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente ⚡️', 'Se Registro Correctamente');
            return back();
    }

    //Elimina detalle caja hostal
    public function destroydetallecaja(DetalleCaja $detallecaja){
        $item = $detallecaja->articulocaja()->count();
        if ($item > 0) {
            notify()->error('Noce Puede Borrar') or notify()->success('Noce Puede Borrar ⚡️', 'Noce Puede Borrar');
            return back();
        }
        $detallecaja->delete();

        $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
        $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
        $resultadohostal = $hostal_ingreso-$hostal_egreso;

        $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
        $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
        $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;

        $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
        $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');

        $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;

        $cajas = Caja:: findOrFail($detallecaja->caja_id);
        $cajas->caja_hostal_ingreso = $hostal_ingreso;
        $cajas->caja_hostal_egreso = $hostal_egreso;
        $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
        $cajas->caja_restaurante_egreso = $restaurante_egreso;
        $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
        $cajas->total = $totalfinal;
        $cajas->caja_depositos_ingreso = $depositos_ingreso;
        $cajas->save();
        
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $totals = [
            'cajagrande' => $cajagrande,
            'detalleIngreso' => $detalleIngreso,
            'detalleEgreso' => $detalleEgreso,
            'total' => $total,
        ];
        
        return response()->json([
            'totals' => $totals,
        ]);
       
    }

    //Elimina detalle caja restaurante
    public function destroydetallecajaRestaurante(DetalleCaja $detallecaja){
        $item = $detallecaja->articulocaja()->count();
        if ($item > 0) {
            notify()->error('Noce Puede Borrar') or notify()->success('Noce Puede Borrar ⚡️', 'Noce Puede Borrar');
            return back();
        }
        $detallecaja->delete();

        $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
        $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
        $resultadohostal = $hostal_ingreso-$hostal_egreso;

        $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
        $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
        $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;

        $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
        $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');

        $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;

        $cajas = Caja:: findOrFail($detallecaja->caja_id);
        $cajas->caja_hostal_ingreso = $hostal_ingreso;
        $cajas->caja_hostal_egreso = $hostal_egreso;
        $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
        $cajas->caja_restaurante_egreso = $restaurante_egreso;
        $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
        $cajas->total = $totalfinal;
        $cajas->caja_depositos_ingreso = $depositos_ingreso;
        $cajas->save();
        
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $totals = [
            'cajagrande' => $cajagrande,
            'detalleIngreso' => $detalleIngreso,
            'detalleEgreso' => $detalleEgreso,
            'total' => $total,
        ];
        
        return response()->json([
            'totals' => $totals,
        ]);
       
    }

    //Elimina detalle caja tarjetas
    public function destroydetallecajaTarjetas(DetalleCaja $detallecaja){
        $item = $detallecaja->articulocaja()->count();
        if ($item > 0) {
            notify()->error('Noce Puede Borrar') or notify()->success('Noce Puede Borrar ⚡️', 'Noce Puede Borrar');
            return back();
        }
        $detallecaja->delete();

        $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
        $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
        $resultadohostal = $hostal_ingreso-$hostal_egreso;

        $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
        $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
        $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;

        $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
        $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');

        $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;

        $cajas = Caja:: findOrFail($detallecaja->caja_id);
        $cajas->caja_hostal_ingreso = $hostal_ingreso;
        $cajas->caja_hostal_egreso = $hostal_egreso;
        $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
        $cajas->caja_restaurante_egreso = $restaurante_egreso;
        $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
        $cajas->total = $totalfinal;
        $cajas->caja_depositos_ingreso = $depositos_ingreso;
        $cajas->save();
        
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $totals = [
            'cajagrande' => $cajagrande,
            'detalleIngreso' => $detalleIngreso,
            'detalleEgreso' => $detalleEgreso,
            'total' => $total,
        ];
        
        return response()->json([
            'totals' => $totals,
        ]);
       
    }

    //Elimina detalle caja depositos
    public function destroydetallecajaDepositos(DetalleCaja $detallecaja){
        $item = $detallecaja->articulocaja()->count();
        if ($item > 0) {
            notify()->error('Noce Puede Borrar') or notify()->success('Noce Puede Borrar ⚡️', 'Noce Puede Borrar');
            return back();
        }
        $detallecaja->delete();

        $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
        $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
        $resultadohostal = $hostal_ingreso-$hostal_egreso;

        $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
        $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
        $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;

        $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
        $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');

        $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;

        $cajas = Caja:: findOrFail($detallecaja->caja_id);
        $cajas->caja_hostal_ingreso = $hostal_ingreso;
        $cajas->caja_hostal_egreso = $hostal_egreso;
        $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
        $cajas->caja_restaurante_egreso = $restaurante_egreso;
        $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
        $cajas->total = $totalfinal;
        $cajas->caja_depositos_ingreso = $depositos_ingreso;
        $cajas->save();
        
        $cajagrande = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->where('detalle_cajas.articulo_caja_id', '=', 29)
        ->sum('Ingreso');
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Egreso')
        ->where('detalle_cajas.caja_id', '=', $detallecaja->caja_id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->sum('Egreso');
        $total = ($cajagrande+$detalleIngreso)-$detalleEgreso;

        $totals = [
            'cajagrande' => $cajagrande,
            'detalleIngreso' => $detalleIngreso,
            'detalleEgreso' => $detalleEgreso,
            'total' => $total,
        ];
        
        return response()->json([
            'totals' => $totals,
        ]);
       
    }

    public function updatedetallecaja(Request $request, $id){
        try {
                DB::beginTransaction();
                $DatosDetalle = DetalleCaja:: findOrFail($id); 
                $DatosDetalle->caja_id = $request->caja_id;
                $DatosDetalle->codigo_caja_id = $request->codigo_caja_id2;
                $DatosDetalle->articulo_caja_id = $request->articulo_caja_id2;
                $DatosDetalle->Articulo_description = $request->Articulo_description;
                $DatosDetalle->Factura = $request->Factura;
                $DatosDetalle->Ingreso = $request->Ingreso;
                $DatosDetalle->Egreso = $request->Egreso;
                $DatosDetalle->Fecha_registro = $request->Fecha_registro;
                $DatosDetalle->save();

                //return response()->json($request);
                //actualizar total
                $hostal_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Ingreso');
                $hostal_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 2)->sum('Egreso');
                $resultadohostal = $hostal_ingreso-$hostal_egreso;

                $restaurante_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Ingreso');
                $restaurante_egreso = DetalleCaja::select('Egreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 1)->sum('Egreso');
                $resultadorestaurante = $restaurante_ingreso-$restaurante_egreso;

                $tarjetas_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 3)->sum('Ingreso');
                $depositos_ingreso = DetalleCaja::select('Ingreso')->where('detalle_cajas.caja_id', '=', $request->caja_id)->where('detalle_cajas.codigo_caja_id', '=', 4)->sum('Ingreso');
                
                $totalfinal = $resultadohostal+$resultadorestaurante+$tarjetas_ingreso+$depositos_ingreso;
                
                $cajas = Caja:: findOrFail($request->caja_id);
                $cajas->caja_hostal_ingreso = $hostal_ingreso;
                $cajas->caja_hostal_egreso = $hostal_egreso;
                $cajas->caja_restaurante_ingreso = $restaurante_ingreso;
                $cajas->caja_restaurante_egreso = $restaurante_egreso;
                $cajas->caja_tarjetas_ingreso = $tarjetas_ingreso;
                $cajas->total = $totalfinal;
                $cajas->caja_depositos_ingreso = $depositos_ingreso;
                $cajas->save();
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                notify()->error('No Se Pudo Actualizar El Registro') or notify()->error('No Se Pudo Actualizar El Registro ⚡️', 'No Se Pudo Actualizar El Registro');
                return back();
            }
                notify()->success('Se Actualizo La Informacion correctamente') or notify()->success('Se Actualizo La Informacion correctamente ⚡️', 'Se Actualizo La Informacion correctamente');
                return back();
    }

    public function updatecodigo(Request $request, $id){
        try {
            DB::beginTransaction();
            $Datoscodigo = CodigoCaja:: findOrFail($id); 
            $Datoscodigo->Nombre = $request->Nombre;
            $Datoscodigo->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Actualizar El Registro') or notify()->error('No Se Pudo Actualizar El Registro ⚡️', 'No Se Pudo Actualizar El Registro');
            return back();
        }
            notify()->success('Se Actualizo La Informacion correctamente') or notify()->success('Se Actualizo La Informacion correctamente ⚡️', 'Se Actualizo La Informacion correctamente');
            return back();
    }

    public function updatearticulo(Request $request, $id){
        try {
            DB::beginTransaction();
            $Datosarticulo = ArticuloCaja:: findOrFail($id); 
            $Datosarticulo->Nombre_Articulo = $request->Nombre_Articulo;
            $Datosarticulo->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Actualizar El Registro') or notify()->error('No Se Pudo Actualizar El Registro ⚡️', 'No Se Pudo Actualizar El Registro');
            return back();
        }
            notify()->success('Se Actualizo La Informacion correctamente') or notify()->success('Se Actualizo La Informacion correctamente ⚡️', 'Se Actualizo La Informacion correctamente');
            return back();
    }

    public function destroycodigo(CodigoCaja $codigoCaja){
        $item = $codigoCaja->detallecajas()->count();
        if ($item > 0) {
            notify()->error('Noce Puede Borrar') or notify()->success('Noce Puede Borrar ⚡️', 'Noce Puede Borrar');
            return back();
            //return redirect()->route('admin.categoria.index');
        }
        //return response()->json($codigoCaja);
        $codigoCaja->delete();
        notify()->success('Se Borro Correctamente') or notify()->success('Se Borro Correctamente ⚡️', 'Se Borro Correctamente');
        return back();
        //return redirect()->route('admin.categoria.index');
    }
    
    public function destroyarticulo(ArticuloCaja $articuloCaja){
        $item = $articuloCaja->detallecajas()->count();
        if ($item > 0) {
            notify()->error('Noce Puede Borrar') or notify()->success('Noce Puede Borrar ⚡️', 'Noce Puede Borrar');
            return back();
            //return redirect()->route('admin.categoria.index');
        }
        //return response()->json($codigoCaja);
        $articuloCaja->delete();
        notify()->success('Se Borro Correctamente') or notify()->success('Se Borro Correctamente ⚡️', 'Se Borro Correctamente');
        return back();
        //return redirect()->route('admin.categoria.index');
    }

    public function destroycaja(Caja $caja){
        $item = $caja->detallecajas()->count();
        if ($item > 0) {
            notify()->error('Noce Puede Borrar') or notify()->success('Noce Puede Borrar ⚡️', 'Noce Puede Borrar');
            return back();
            //return redirect()->route('admin.categoria.index');
        }
        //return response()->json($codigoCaja);
        $caja->delete();
        notify()->success('Se Borro Correctamente') or notify()->success('Se Borro Correctamente ⚡️', 'Se Borro Correctamente');
        return back();
        //return redirect()->route('admin.categoria.index');
    }

    public function autocompletecodigo(Request $request){
        $data = CodigoCaja::select("Nombre as value","id")
                    ->where('Nombre', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function autocompletearticulo(Request $request){
        $data = ArticuloCaja::select("Nombre_Articulo as value", "Codigo_caja", "id")
                    ->where('Nombre_Articulo', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function autarticulo(Request $request){
        $data = ArticuloCaja::select("Nombre_Articulo as value", "Codigo_caja", "id")
                    ->where('Nombre_Articulo', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function buscador(Request $request){
        /*
         $tipoclientes = Cliente::select('tipo_clientes.Nombre_tipoclientes')
        ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
         */
        $descripcion = $request->get('texto_descripcion');
        $texto = $request->get('id_text');
        $textocodigo = $request->get('id_text_codigo');
        $desde = $request->get('daterangepicker_start');
        $hasta = $request->get('daterangepicker_end');
        $detallecajas = [];
        $detallecajas = DetalleCaja::select('*')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->where('detalle_cajas.articulo_caja_id', 'LIKE', $texto)
        ->where('detalle_cajas.codigo_caja_id', 'LIKE', $textocodigo)
        ->where('detalle_cajas.Articulo_description', 'LIKE', '%'.$descripcion.'%')
        ->whereBetween('detalle_cajas.Fecha_registro', [$desde, $hasta])
        ->get();
        $pdf = PDF::loadView('admin.caja.reportescaja',compact('detallecajas','desde','hasta'));
        return $pdf->stream('reportescaja'.'pdf');
        //return view('admin.caja.reportescaja',compact('detallecajas'));
        //return response()->json($detallecajas);
    }

    public function buscarhostal(Caja $caja,Request $request){

        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();
        $texto = $request->get('buscar_hostal');
        $detallecajas = DetalleCaja::select('detalle_cajas.id','codigo_cajas.Nombre','articulo_cajas.Codigo_caja'
                                            ,'articulo_cajas.Nombre_Articulo','detalle_cajas.Articulo_description'
                                            ,'detalle_cajas.Fecha_registro','detalle_cajas.Ingreso','detalle_cajas.Egreso'
                                            ,'detalle_cajas.articulo_caja_id','detalle_cajas.Factura'
                                            ,'detalle_cajas.codigo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 2)
        ->Where('detalle_cajas.Articulo_description', 'LIKE', '%'.$texto.'%')
        ->get();
        //return response()->json($detallecajas);
        return view('admin.caja.busquedahostal',compact('detallecajas','caja','codigos','articulos'));
    }

    public function buscarrestaurante(Caja $caja,Request $request){

        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();
        $texto = $request->get('buscar_hostal');
        $detallecajas = DetalleCaja::select('detalle_cajas.id','codigo_cajas.Nombre','articulo_cajas.Codigo_caja'
                                            ,'articulo_cajas.Nombre_Articulo','detalle_cajas.Articulo_description'
                                            ,'detalle_cajas.Fecha_registro','detalle_cajas.Ingreso','detalle_cajas.Egreso'
                                            ,'detalle_cajas.articulo_caja_id','detalle_cajas.Factura'
                                            ,'detalle_cajas.codigo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 1)
        ->Where('detalle_cajas.Articulo_description', 'LIKE', '%'.$texto.'%')
        ->get();
        //return response()->json($detallecajas);
        return view('admin.caja.buscarrestaurante',compact('detallecajas','caja','codigos','articulos'));
    }

    public function buscartarjeta(Caja $caja,Request $request){

        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();
        $texto = $request->get('buscar_hostal');
        $detallecajas = DetalleCaja::select('detalle_cajas.id','codigo_cajas.Nombre','articulo_cajas.Codigo_caja'
                                            ,'articulo_cajas.Nombre_Articulo','detalle_cajas.Articulo_description'
                                            ,'detalle_cajas.Fecha_registro','detalle_cajas.Ingreso','detalle_cajas.Egreso'
                                            ,'detalle_cajas.articulo_caja_id','detalle_cajas.Factura'
                                            ,'detalle_cajas.codigo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 3)
        ->Where('detalle_cajas.Articulo_description', 'LIKE', '%'.$texto.'%')
        ->get();
        //return response()->json($detallecajas);
        return view('admin.caja.buscartarjeta',compact('detallecajas','caja','codigos','articulos'));
    }

    public function buscardeposito(Caja $caja,Request $request){

        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();
        $texto = $request->get('buscar_hostal');
        $detallecajas = DetalleCaja::select('detalle_cajas.id','codigo_cajas.Nombre','articulo_cajas.Codigo_caja'
                                            ,'articulo_cajas.Nombre_Articulo','detalle_cajas.Articulo_description'
                                            ,'detalle_cajas.Fecha_registro','detalle_cajas.Ingreso','detalle_cajas.Egreso'
                                            ,'detalle_cajas.articulo_caja_id','detalle_cajas.Factura'
                                            ,'detalle_cajas.codigo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->where('detalle_cajas.codigo_caja_id', '=', 4)
        ->Where('detalle_cajas.Articulo_description', 'LIKE', '%'.$texto.'%')
        ->get();
        //return response()->json($detallecajas);
        return view('admin.caja.buscardeposito',compact('detallecajas','caja','codigos','articulos'));
    }

    public function reportescajapersonalizado(Request $request){
        $texto = $request->get('id_text');
        $textocodigo = $request->get('id_text_codigo');
        $desde = $request->get('desde_fecha');
        $hasta = $request->get('hasta_fecha');
        $detallecajas = [];
        $detallecajas = DetalleCaja::select('*')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->where('detalle_cajas.articulo_caja_id', 'LIKE', $texto)
        ->where('detalle_cajas.codigo_caja_id', 'LIKE', $textocodigo)
        ->whereBetween('detalle_cajas.Fecha_registro', [$desde, $hasta])
        ->get();
        $pdf = PDF::loadView('admin.caja.reportescajapersonalizado',compact('detallecajas'));
        return $pdf->stream('reportesfullexportar'.'pdf');
        //return response()->json($cajas);
    }
    
    public function Cajapdf(Caja $caja,Request $request){
            set_time_limit(0);
            ini_set("memory_limit",-1);
            ini_set('max_execution_time', 0);
            $codigos = CodigoCaja::get();
            $articulos = ArticuloCaja::get();
            $detallecajas = DetalleCaja::select('*')
            ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
            ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
            ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
            ->where('detalle_cajas.caja_id', '=', $caja->id)->orderBy('detalle_cajas.id', 'desc')->get();
    
            $detalleIngreso = DetalleCaja::select('Ingreso')
            ->where('detalle_cajas.caja_id', '=', $caja->id)
            ->sum('Ingreso');
            $detalleEgreso = DetalleCaja::select('Ingreso')
            ->where('detalle_cajas.caja_id', '=', $caja->id)
            ->sum('Egreso');
            $total = $detalleIngreso-$detalleEgreso;
            
            //return view('admin.caja.pdf_caja',compact('detallecajas','caja','codigos','articulos','detalleIngreso','detalleEgreso','total'));
            $pdf = PDF::loadView('admin.caja.pdf_caja',compact('detallecajas','caja','codigos','articulos','detalleIngreso','detalleEgreso','total'));
            return $pdf->stream('Reporte_de_venta'.$caja->id.'pdf');
            //$pdf = PDF::loadView('admin.caja.pdf_caja',compact('detallecajas','caja','codigos','articulos','detalleIngreso','detalleEgreso','total'));
            //$pdf->setPaper('A4', 'landscape');
            //return $pdf->stream('Reporte_de_venta'.'pdf');
            //return $pdf->download(Now().'_Articulos'.'.pdf');
            
    }
    
    public function reporte_mes_especifico(Caja $caja){
        //return response()->json($caja);
        $fecha = new DateTime($caja->fecha_registro);
        $ultimoDiaMes = new DateTime($fecha->format('Y-m-t'));
        $primerDiaMes = new DateTime($fecha->format('Y-m-01'));
        $diasDelMes = array();
        $registrosPorDia = array();

        $CajaGrandeHostal = DetalleCaja::select('Ingreso')
                ->where('detalle_cajas.caja_id', '=', $caja->id)
                ->where('detalle_cajas.codigo_caja_id', '=', 2)
                ->where('detalle_cajas.articulo_caja_id', '=', 29)
                ->sum('Egreso');
        $CajaGrandeRestaurante = DetalleCaja::select('Ingreso')
                ->where('detalle_cajas.caja_id', '=', $caja->id)
                ->where('detalle_cajas.codigo_caja_id', '=', 1)
                ->where('detalle_cajas.articulo_caja_id', '=', 29)
                ->sum('Egreso');

        $cantidadDias = (int)$ultimoDiaMes->format('d');
        for ($i = 1; $i <= $cantidadDias; $i++) {
            $dia = new DateTime($fecha->format('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT));
            array_push($diasDelMes, $dia);
            $registrosPorDia[$dia->format('Y-m-d')] = array();
        }

        foreach ($diasDelMes as $dia) {
            $registrosDia = DetalleCaja::
                        join('articulo_cajas','articulo_cajas.id','detalle_cajas.articulo_caja_id')
                        ->whereDate('fecha_registro', $dia->format('Y-m-d'))
                ->where('caja_id', $caja->id)
                ->orderBy('articulo_cajas.Nombre_Articulo')
                ->get();
            $registrosPorDia[$dia->format('Y-m-d')] = $registrosDia;
        }

        //return response()->json($registrosPorDia);

        $pdf = PDF::loadView('admin.caja.reporte_mes_especifico',['diasDelMes' => $diasDelMes, 'registrosPorDia' => $registrosPorDia],
                     compact('caja', 'CajaGrandeHostal', 'CajaGrandeRestaurante'));
        return $pdf->stream('ReporteMes'.$caja->id.'pdf');
    }

    public function Cajaexcel(Caja $caja,Request $request){
        //$res_id = ;
        //return response()->json($caja->id);
        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();
        $detallecajas = DetalleCaja::select('*')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)->orderBy('detalle_cajas.id', 'desc')->get();
        
        $detalleIngreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->sum('Ingreso');
        $detalleEgreso = DetalleCaja::select('Ingreso')
        ->where('detalle_cajas.caja_id', '=', $caja->id)
        ->sum('Egreso');
        $total = $detalleIngreso-$detalleEgreso;
        return Excel::download(new CajaExport($caja->id,$total,$codigos,$articulos,$detallecajas,$detalleIngreso,$detalleEgreso), Now().'_Articulos.xlsx');
    } 

    public function reportesfull(){
        $cajas = Caja::get();
        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();
        //$detallecajas = DetalleCaja::get();
        $detallecajas = DetalleCaja::select('*')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->orderBy('detalle_cajas.id', 'desc')->get();
        $data = [];
        
        foreach($cajas as $caja){
            $data['label'][] = $caja->fecha_registro;
            $data['data'][] = $caja->total;
            
        }
        $data['data'] = json_encode($data);

        return view('admin.caja.reportesfull',$data,compact('cajas','detallecajas','codigos','articulos'));
        //return response()->json($cajas);
    }
    
    public function reportesfullexportar(){
        $cajas = Caja::get();
        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();
        //$detallecajas = DetalleCaja::get();
        $detallecajas = DetalleCaja::select('*')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->orderBy('detalle_cajas.id', 'desc')->get();

        $pdf = PDF::loadView('admin.caja.reportesfullexportar',compact('cajas','detallecajas','codigos','articulos'));
        return $pdf->stream('reportesfullexportar'.'pdf');
        //return response()->json($cajas);
    }

    public function reporte_mensual(Caja $caja,Request $request){
        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();
        //$count = Model::count();            

        $detallecajas = DetalleCaja::select('detalle_cajas.id','detalle_cajas.caja_id','detalle_cajas.codigo_caja_id','detalle_cajas.articulo_caja_id','detalle_cajas.Articulo_description',
        'detalle_cajas.Ingreso','detalle_cajas.Egreso','detalle_cajas.Fecha_registro','detalle_cajas.Factura','detalle_cajas.created_at','detalle_cajas.updated_at',
        'articulo_cajas.Nombre_Articulo','articulo_cajas.Codigo_caja','user_id','cajas.fecha_registro','codigo_cajas.Nombre')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)->orderBy('detalle_cajas.id', 'desc')->get();
        $data = [];
        
        foreach($articulos as $articulo){
            $data['label'][] = $articulo->Nombre_articulo;
            $data['data'][] = $articulo->count();
            
        }
        $data['data'] = json_encode($data);
        //return response()->json($data);
        return view('admin.caja.reporte_mensual',$data,compact('detallecajas','articulos'));
    }

    public function reporte_mensual_unique(Caja $caja,Request $request){
        $codigos = CodigoCaja::get();
        $articulos = ArticuloCaja::get();

        $detallecajas = DetalleCaja::select('detalle_cajas.id','detalle_cajas.caja_id','detalle_cajas.codigo_caja_id','detalle_cajas.articulo_caja_id','detalle_cajas.Articulo_description',
        'detalle_cajas.Ingreso','detalle_cajas.Egreso','detalle_cajas.Fecha_registro','detalle_cajas.Factura','detalle_cajas.created_at','detalle_cajas.updated_at',
        'articulo_cajas.Nombre_Articulo','articulo_cajas.Codigo_caja','user_id','cajas.fecha_registro','codigo_cajas.Nombre')
        ->join('articulo_cajas', 'articulo_cajas.id', '=', 'detalle_cajas.articulo_caja_id')
        ->join('cajas', 'cajas.id', '=', 'detalle_cajas.caja_id')
        ->join('codigo_cajas', 'codigo_cajas.id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.codigo_caja_id', '=', 'detalle_cajas.codigo_caja_id')
        ->where('detalle_cajas.caja_id', '=', $caja->id)->orderBy('detalle_cajas.id', 'desc')->get();
        
        //return response()->json($codigos);
        return view('admin.caja.reporte_mensual_unique',compact('detallecajas'));
    }

    public function updatedolar(Request $request, $id){
        $cajas = Caja:: findOrFail($id);
        $cajas->DolarHostal = $request->dolar;
        $cajas->save();
        return back();
    }
}
