<?php

namespace App\Http\Controllers;

use App\Models\ControlCamareria;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ControlCamareriaController extends Controller
{

    public function index(){
        $habitaciones = Habitacion::get();
        $registros = ControlCamareria::get();
        $today = date('Y-m-d', strtotime(Now()));
        //return response()->json($today);
        return view('hostal.controlcamareria.index',compact('today','habitaciones','registros'));
    }

    public function storecontrol(Request $request){
        $user = Auth::user(); 
        $controlcamarerias = ControlCamareria::create([
            'habitacion_id' => $request->habitacion_id,
            'user_id' => $user->id,
            'actividad' => $request->accion,
            'observacion' => $request->observacion,
            'fecha_registro' => Carbon::now('America/La_Paz'),
        ]);
        notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente', 'Se Registro Correctamente');
        return back();
    }

    public function reporte(Request $request){
        $mes = substr($request->RegistroMes, 5, 2);
        $anio = substr($request->RegistroMes, 0, 4);
        $primer_dia = Carbon::createFromDate($anio, $mes, 1)->format('Y-m-d');
        $ultimo_dia = Carbon::createFromDate($anio, $mes, 1)->endOfMonth()->format('Y-m-d');
        $fechas = [];
        for ($fecha = Carbon::createFromDate($anio, $mes, 1); $fecha <= Carbon::createFromDate($anio, $mes, 1)->endOfMonth(); $fecha->addDay()) {
            $fechas[] = $fecha->toDateString();
        }
        $habitaciones = Habitacion::get();
        $registros = ControlCamareria::whereDate('fecha_registro', '>=', $primer_dia)
                                      ->whereDate('fecha_registro', '<=', $ultimo_dia)
                                      ->get();
        $data = [];
        foreach ($fechas as $fecha) {
            $fila = ['fecha' => $fecha, 'observacion' => ''];
            foreach ($habitaciones as $habitacion) {
                $registro = $registros->filter(function($registro) use($fecha, $habitacion) {
                    return strpos($registro->fecha_registro, $fecha) !== false && $registro->habitacion_id == $habitacion->id;
                })->first();
                $fila["habitacion_{$habitacion->id}"] = $registro ? $registro->actividad : '';
            }
            $observaciones = ControlCamareria::where('fecha_registro', 'like', "%{$fecha}%")->pluck('observacion')->toArray();
            $fila['observacion'] = implode($observaciones);
            $data[] = $fila;
        }
        
        $pdf = PDF::loadView('hostal.controlcamareria.reporte', compact('habitaciones','registros','data','mes','anio'))
                ->setPaper('A4', 'portrait');
        return $pdf->stream('Planilla'.time().'pdf');
    }
}
