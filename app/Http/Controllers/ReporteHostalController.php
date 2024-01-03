<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\DetalleHospedajeHabitacion;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reserva;
use App\Models\DetalleReserva;
use App\Models\DetalleReservaHabitacion;
use App\Models\Habitacion;
use App\Models\HospedajeHabitacion;
use App\Models\ReservaHabitacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class ReporteHostalController extends Controller
{

    public function index(){
        $habitaciones = Habitacion::get();

        $reservasPorHabitacion = ReservaHabitacion::leftJoin('habitacions', 'habitacions.id', '=', 'reserva_habitacions.habitacion_id')
                                ->select(DB::raw('count(reserva_habitacions.id) as reservas, habitacions.Nombre_habitacion as NombreHab'))
                                ->groupBy('habitacions.id')
                                ->get()->toArray();
        
        $hospedajesPorHabitacion = HospedajeHabitacion::leftJoin('habitacions', 'habitacions.id', '=', 'hospedaje_habitacions.habitacion_id')
                                ->select(DB::raw('count(hospedaje_habitacions.id) as hospedajes, habitacions.Nombre_habitacion as NombreHab'))
                                ->groupBy('habitacions.id')
                                ->get()->toArray();

        $HospedajeMes = DB::select('SELECT month(hospedaje_habitacions.ingreso_hospedaje) as mes, sum(hospedaje_habitacions.TotalGeneralHospedaje) as totalmes, hospedaje_habitacions.created_at as fecha
                                    from hospedaje_habitacions  
                                    group by month(hospedaje_habitacions.ingreso_hospedaje) 
                                    order by month(hospedaje_habitacions.ingreso_hospedaje) desc limit 12'); 

        $ReservaMes = DB::select('SELECT month(reserva_habitacions.ingreso_reserva) as mes, sum(reserva_habitacions.TotalGeneralHospedaje_reserva) as totalmes, reserva_habitacions.created_at as fecha
                                    from reserva_habitacions  
                                    group by month(reserva_habitacions.ingreso_reserva) 
                                    order by month(reserva_habitacions.ingreso_reserva) desc limit 12');                                  

        //return response()->json($ReservaMes);
        return view('hostal.ReportesHostal.FullReportes',compact('habitaciones','HospedajeMes','ReservaMes'),['reservasPorHabitacion' => $reservasPorHabitacion, 'hospedajesPorHabitacion' => $hospedajesPorHabitacion]);
    }
    
    public function ReporteRangeDate(Request $request){
        $desde = $request->get('Inicio_Fecha');
        $hasta = $request->get('Final_Fecha');
        $habID = $request->get('habitacion_id');
        $TipodID = $request->get('TipoAlquiler');

        $from = Carbon::parse($desde)->format('Y-m-d');
        $to = Carbon::parse($hasta)->format('Y-m-d');
        $data = [];
        $DetalleHospedajes = DetalleHospedajeHabitacion::select('*')
                            ->join('cliente_hostals','cliente_hostals.id','detalle_hospedaje_habitacions.cliente_id')
                            ->get();
        $DetalleReservas = DetalleReservaHabitacion::select('*')
                            ->join('cliente_hostals','cliente_hostals.id','detalle_reserva_habitacions.cliente_id')
                            ->get();
        if($TipodID == 'HospedajeID'){
            if($habID == 0){
                $data = HospedajeHabitacion::join('users as u', 'u.id', 'hospedaje_habitacions.user_id')
                    ->join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')
                    ->select('hospedaje_habitacions.*', 'u.name as user','habitacions.Nombre_habitacion')
                    ->where('hospedaje_habitacions.TotalGeneralHospedaje','>', 0)
                    ->whereBetween('hospedaje_habitacions.salida_hospedaje', [$from, $to])
                    ->get();
            }else{
                $data = HospedajeHabitacion::join('users as u', 'u.id', 'hospedaje_habitacions.user_id')
                    ->join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')
                    ->select('hospedaje_habitacions.*', 'u.name as user','habitacions.Nombre_habitacion')
                    ->where('hospedaje_habitacions.habitacion_id',$habID)
                    ->where('hospedaje_habitacions.TotalGeneralHospedaje','>', 0)
                    ->whereBetween('hospedaje_habitacions.salida_hospedaje', [$from, $to])
                    ->get();
            }
        }else{
            if($habID == 0){
                $data = ReservaHabitacion::join('users as u', 'u.id', 'reserva_habitacions.user_id')
                    ->join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
                    ->select('reserva_habitacions.*', 'u.name as user','habitacions.Nombre_habitacion')
                    ->where('reserva_habitacions.TotalGeneralHospedaje_reserva','>', 0)
                    ->whereBetween('reserva_habitacions.ingreso_reserva', [$from, $to])
                    ->get();
            }else{
                $data = ReservaHabitacion::join('users as u', 'u.id', 'reserva_habitacions.user_id')
                    ->join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
                    ->select('reserva_habitacions.*', 'u.name as user','habitacions.Nombre_habitacion')
                    ->where('reserva_habitacions.habitacion_id',$habID)
                    ->where('reserva_habitacions.TotalGeneralHospedaje_reserva','>', 0)
                    ->whereBetween('reserva_habitacions.ingreso_reserva', [$from, $to])
                    ->get();
            }
        }
        $cantidad = Habitacion::get();
        //return response()->json($data);
        $pdf = PDF::loadView('hostal.ReportesHostal.ReporteRangeDate',compact('DetalleReservas','DetalleHospedajes','TipodID','habID','data','desde','hasta'))
        ->setOptions(['defaultFont' => 'sans-serif','isRemoteEnabled' => true, 'chroot' => public_path('storage/e-signatures')]);
        return $pdf->stream('ReportHostalRangeDate'.time().'.pdf');
    }

    public function ReporteMeses(Request $request){
        $desde = $request->get('Inicio_Fecha');
        $hasta = $request->get('Final_Fecha');
        $habID = $request->get('habitacion_id');
        $TipodID = $request->get('TipoAlquiler');
        $Month = $request->get('monthID');

        $from = Carbon::parse($desde)->format('Y-m-d');
        $to = Carbon::parse($hasta)->format('Y-m-d');
        $data = [];
        $DetalleHospedajes = DetalleHospedajeHabitacion::select('*')
                            ->join('cliente_hostals','cliente_hostals.id','detalle_hospedaje_habitacions.cliente_id')
                            ->get();
        $DetalleReservas = DetalleReservaHabitacion::select('*')
                            ->join('cliente_hostals','cliente_hostals.id','detalle_reserva_habitacions.cliente_id')
                            ->get();
        if($TipodID == 'HospedajeID'){
            if($habID == 0){
                $data = HospedajeHabitacion::join('users as u', 'u.id', 'hospedaje_habitacions.user_id')
                    ->join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')
                    ->select('hospedaje_habitacions.*', 'u.name as user','habitacions.Nombre_habitacion')
                    ->where('hospedaje_habitacions.TotalGeneralHospedaje','>', 0)
                    ->where(DB::raw("(DATE_FORMAT(hospedaje_habitacions.ingreso_hospedaje,'%Y-%m-%d'))"), ">=", $Month)
                    ->get();
            }else{
                $data = HospedajeHabitacion::join('users as u', 'u.id', 'hospedaje_habitacions.user_id')
                    ->join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')
                    ->select('hospedaje_habitacions.*', 'u.name as user','habitacions.Nombre_habitacion')
                    ->where('hospedaje_habitacions.habitacion_id',$habID)
                    ->where('hospedaje_habitacions.TotalGeneralHospedaje','>', 0)
                    ->where(DB::raw("(DATE_FORMAT(hospedaje_habitacions.ingreso_hospedaje,'%Y-%m-%d'))"), ">=", $Month)
                    ->get();
            }
        }else{
            if($habID == 0){
                $data = ReservaHabitacion::join('users as u', 'u.id', 'reserva_habitacions.user_id')
                    ->join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
                    ->select('reserva_habitacions.*', 'u.name as user','habitacions.Nombre_habitacion')
                    ->where('reserva_habitacions.TotalGeneralHospedaje_reserva','>', 0)
                    ->where(DB::raw("(DATE_FORMAT(hospedaje_habitacions.ingreso_hospedaje,'%Y-%m-%d'))"), ">=", $Month)
                    ->get();
            }else{
                $data = ReservaHabitacion::join('users as u', 'u.id', 'reserva_habitacions.user_id')
                    ->join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
                    ->select('reserva_habitacions.*', 'u.name as user','habitacions.Nombre_habitacion')
                    ->where('reserva_habitacions.habitacion_id',$habID)
                    ->where('reserva_habitacions.TotalGeneralHospedaje_reserva','>', 0)
                    ->where(DB::raw("(DATE_FORMAT(hospedaje_habitacions.ingreso_hospedaje,'%Y-%m-%d'))"), ">=", $Month)
                    ->get();
            }
        }
        //return response()->json($data);
        //return view('hostal.ReportesHostal.ResultReport',compact('DetalleReservas','DetalleHospedajes','TipodID','habID','data','desde','hasta'));
        $pdf = PDF::loadView('hostal.ReportesHostal.ReporteRangeDate',compact('DetalleReservas','DetalleHospedajes','TipodID','habID','data','desde','hasta'))
        ->setOptions(['defaultFont' => 'sans-serif','isRemoteEnabled' => true, 'chroot' => public_path('storage/e-signatures')]);
        return $pdf->stream('ReportHostalRangeDate'.time().'.pdf');
    }

    public function ReporteSemanas(Request $request){
        $desde = $request->get('inicioweek');
        $hasta = $request->get('finweek');
        $habID = $request->get('habitacion_id');
        $TipodID = $request->get('TipoAlquiler');

        $from = Carbon::parse($desde)->format('Y-m-d');
        $to = Carbon::parse($hasta)->format('Y-m-d');
        $data = [];
        $DetalleHospedajes = DetalleHospedajeHabitacion::select('*')
                            ->join('cliente_hostals','cliente_hostals.id','detalle_hospedaje_habitacions.cliente_id')
                            ->get();
        $DetalleReservas = DetalleReservaHabitacion::select('*')
                            ->join('cliente_hostals','cliente_hostals.id','detalle_reserva_habitacions.cliente_id')
                            ->get();
        if($TipodID == 'HospedajeID'){
            if($habID == 0){
                $data = HospedajeHabitacion::join('users as u', 'u.id', 'hospedaje_habitacions.user_id')
                    ->join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')
                    ->select('hospedaje_habitacions.*', 'u.name as user','habitacions.Nombre_habitacion')
                    ->where('hospedaje_habitacions.TotalGeneralHospedaje','>', 0)
                    ->whereBetween('hospedaje_habitacions.ingreso_hospedaje', [$from, $to])
                    ->get();
            }else{
                $data = HospedajeHabitacion::join('users as u', 'u.id', 'hospedaje_habitacions.user_id')
                    ->join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')
                    ->select('hospedaje_habitacions.*', 'u.name as user','habitacions.Nombre_habitacion')
                    ->where('hospedaje_habitacions.habitacion_id',$habID)
                    ->where('hospedaje_habitacions.TotalGeneralHospedaje','>', 0)
                    ->whereBetween('hospedaje_habitacions.ingreso_hospedaje', [$from, $to])
                    ->get();
            }
        }else{
            if($habID == 0){
                $data = ReservaHabitacion::join('users as u', 'u.id', 'reserva_habitacions.user_id')
                    ->join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
                    ->select('reserva_habitacions.*', 'u.name as user','habitacions.Nombre_habitacion')
                    ->where('reserva_habitacions.TotalGeneralHospedaje_reserva','>', 0)
                    ->whereBetween('reserva_habitacions.ingreso_reserva', [$from, $to])
                    ->get();
            }else{
                $data = ReservaHabitacion::join('users as u', 'u.id', 'reserva_habitacions.user_id')
                    ->join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
                    ->select('reserva_habitacions.*', 'u.name as user','habitacions.Nombre_habitacion')
                    ->where('reserva_habitacions.habitacion_id',$habID)
                    ->where('reserva_habitacions.TotalGeneralHospedaje_reserva','>', 0)
                    ->whereBetween('reserva_habitacions.ingreso_reserva', [$from, $to])
                    ->get();
            }
        }
        $cantidad = Habitacion::get();
        //return response()->json($data);
        $pdf = PDF::loadView('hostal.ReportesHostal.ReporteRangeDate',compact('DetalleReservas','DetalleHospedajes','TipodID','habID','data','desde','hasta'))
        ->setOptions(['defaultFont' => 'sans-serif','isRemoteEnabled' => true, 'chroot' => public_path('storage/e-signatures')]);
        return $pdf->stream('ReportHostalRangeDate'.time().'.pdf');
    }

   /*  public function getDataByMonth($month){
        $reservasPorHabitacion = HospedajeHabitacion::leftJoin('habitacions', 'habitacions.id', '=', 'hospedaje_habitacions.habitacion_id')
            ->select(DB::raw('count(hospedaje_habitacions.id) as reservas, habitacions.id as habID'))
            ->whereMonth('hospedaje_habitacions.ingreso_hospedaje', $month)
            ->groupBy('habitacions.id')
            ->get()->toArray();

        return response()->json($reservasPorHabitacion);
    } */

    public function getDataByMonth($selectedDate){
        $month = date('m',strtotime($selectedDate));
        $year = date('Y',strtotime($selectedDate));
        $hospedajesPorHabitacion = HospedajeHabitacion::leftJoin('habitacions', 'habitacions.id', '=', 'hospedaje_habitacions.habitacion_id')
                                    ->select(DB::raw('count(hospedaje_habitacions.id) as hospedajes, habitacions.id as habID, habitacions.Nombre_habitacion as NombreHab'))
                                    ->whereMonth('hospedaje_habitacions.ingreso_hospedaje', $month)
                                    ->groupBy('habitacions.id')
                                    ->get();
        return $hospedajesPorHabitacion;
    }

    public function getDataByMonthRes($selectedDate){
        $month = date('m',strtotime($selectedDate));
        $year = date('Y',strtotime($selectedDate));
        $reservasPorHabitacion = ReservaHabitacion::leftJoin('habitacions', 'habitacions.id', '=', 'reserva_habitacions.habitacion_id')
                                    ->select(DB::raw('count(reserva_habitacions.id) as reservas, habitacions.id as habID, habitacions.Nombre_habitacion as NombreHab'))
                                    ->whereMonth('reserva_habitacions.ingreso_reserva', $month)
                                    ->groupBy('habitacions.id')
                                    ->get();
        return $reservasPorHabitacion;
    }


}
