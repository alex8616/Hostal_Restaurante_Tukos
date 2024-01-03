<?php

namespace App\Http\Controllers;

use App\Models\ArticuloCaja;
use App\Models\ClienteHostal;
use App\Models\Habitacion;
use App\Models\HospedajeHabitacion;
use App\Models\DetalleHospedajeHabitacion;
use App\Models\ProductoHostal;
use App\Models\DetalleProducto;
use App\Models\DetalleReservaHabitacion;
use App\Models\DetalleServicioHostal;
use App\Models\ReservaHabitacion;
use App\Models\ServicioHostal;
use App\Models\DetalleCaja;
use App\Models\Caja;
use App\Models\DetalleHospedajeInvitado;
use App\Models\DetalleReservaInvitado;
use App\Models\ReservaHabitacionInvitado;
use App\Models\HospedajeHabitacionInvitado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;

class HabitacionController extends Controller{

    public function index(){
        $habitaciones = Habitacion::get();
        $cambiarhabitaciones = Habitacion::where('habitacions.Estado_habitacion','=','DISPONIBLE')->get();
        $clientes = ClienteHostal::get();
        $HabitacionesDisponibles = Habitacion::where('habitacions.Estado_habitacion','=','DISPONIBLE')->count();
        $HabitacionesOcupadas = Habitacion::where('habitacions.Estado_habitacion','=','OCUPADO')->count();
        $HabitacionesReservas= ReservaHabitacion::where('Estado_reserva','=','ESPERA')->count();
        $HabitacionesTotal= Habitacion::count();
        $hospedajehabitaciones = HospedajeHabitacion::get();
        $reservashabitaciones = ReservaHabitacion::get();
        
        //return response()->json($hospedajehabitaciones);
        return view('hostal.habitaciones.index',compact('HabitacionesTotal','HabitacionesReservas','HabitacionesOcupadas','HabitacionesDisponibles','cambiarhabitaciones','clientes','reservashabitaciones','habitaciones','hospedajehabitaciones'));
    }

    public function CrearHospedaje(Habitacion $habitacion){
        $countries = file_get_contents(public_path('/json/countries.json'));
        $countries = json_decode($countries, true);

        $data = file_get_contents(public_path('/json/departamentos.json'));
        $departamentos = json_decode($data, true);

        //return response()->json($countries);
        return view('hostal.habitaciones.CrearHospedaje', compact('habitacion','departamentos'))->with('countries', $countries);
    }

    public function CrearReserva(Habitacion $habitacion){
        $countries = file_get_contents(public_path('/json/countries.json'));
        $countries = json_decode($countries, true);

        $data = file_get_contents(public_path('/json/departamentos.json'));
        $departamentos = json_decode($data, true);

        //return response()->json($countries);
        return view('hostal.habitaciones.CrearReserva', compact('habitacion','departamentos'))->with('countries', $countries);
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            $datosHabitacion = request()->except('_token');
            $habitacion = Habitacion::create($datosHabitacion);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar⚡️', 'NO Registrado');
            return redirect()->route('hostal.habitacion.index');
        }
            notify()->success('Se Registro correctamente') or notify()->success('Se registró correctamente ⚡️', 'Registrado Correctamente');
            return redirect()->route('hostal.habitacion.index');
    }

    public function hospedajestore(Request $request){
        try {
            DB::beginTransaction();
            $user = Auth::user();
                foreach($request->cliente_id as $key=>$insert){
                    $results[] = array("cliente_id" => $request->cliente_id[$key]);
                }

                $user = Auth::user();
                $hospedajehabitacion = HospedajeHabitacion::create([
                    'habitacion_id' => $request->habitacion_id,
                    'ingreso_hospedaje' => $request->ingreso_hospedaje,
                    'salida_hospedaje' => Carbon::parse($request->salida_hospedaje)->format('Y-m-d') . ' 23:59:59',
                    'procedencia_hospedaje' => $request->procedencia_hospedaje,
                    'destino_hospedaje' => $request->destino_hospedaje,
                    'dias_hospedarse' => $request->dias_hospedarse,
                    'Precio_habitacion' => $request->Precio_habitacion,
                    'PrecioRestante' => $request->PrecioRestante,
                    'Adelanto' => $request->Adelanto,
                    'Total' => $request->Total,
                    'CategoriaHabitacion' => $request->CategoriaHabitacion, 
                    'user_id' => Auth::user()->id,
                    'CamaraHotelera' => $request->CamaraHotelera,
                ]);

                $hospedajehabitacion->detallehospedajes()->createMany($results);

                $estadohabitacion = Habitacion:: findOrFail($request->habitacion_id);
                $estadohabitacion->Estado_habitacion = 'OCUPADO';
                $estadohabitacion->save();

                DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ', 'No Se Pudo Registrar ');
            return redirect()->route('hostal.habitacion.index');
        }
            notify()->success('Se Registro Correctamente ') or notify()->success('Se Registro Correctamente ', 'Se Registro Correctamente ');
            return redirect()->route('hostal.habitacion.index');
    }

    public function reservastore(Request $request){
        $from = Carbon::parse($request->ingreso_reserva);
        $to = Carbon::parse($request->salida_reserva)->format('Y-m-d');

        $dates = [];

        for($d = $from; $d->lte($to); $d->addDay()) {
                $dates[] = $d->format('Y-m-d');
            
        }
        
        //return response()->json($dates);
        
        $existe_solapamiento = ReservaHabitacion::where('habitacion_id', $request->habitacion_id)
        ->where(function($query) use ($request) {
            $query->where('ingreso_reserva', '>=', $request->ingreso_reserva)
                ->where('ingreso_reserva', '<', $request->salida_reserva)
                ->orWhere(function($query) use ($request) {
                    $query->where('salida_reserva', '>', $request->ingreso_reserva)
                        ->where('salida_reserva', '<=', $request->salida_reserva);
                })
                ->orWhere(function($query) use ($request) {
                    $query->where('ingreso_reserva', '<=', $request->ingreso_reserva)
                        ->where('salida_reserva', '>=', $request->salida_reserva);
                });
        })
        ->exists();

        if ($existe_solapamiento) {
            notify()->error('error', 'Noce Puede Registrar Por Que Ya Hay Una RESERVA En las FECHAS') or notify()->error('error', 'Noce Puede Registrar Por Que Ya Hay Una RESERVA En La Hora Seleccionada');
            return back(); 
        } else {
            try {
                DB::beginTransaction();
                //return response()->json($request);
                $user = Auth::user();
                    foreach($request->cliente_id as $key=>$insert){
                        $results[] = array("cliente_id" => $request->cliente_id[$key]);
                    }

                    $user = Auth::user();
                    $reservahabitacion = ReservaHabitacion::create([
                        'habitacion_id' => $request->habitacion_id,
                        'ingreso_reserva' => $request->ingreso_reserva,
                        'salida_reserva' => Carbon::parse($request->salida_reserva)->format('Y-m-d') . ' 23:59:59',
                        'dias_reserva' => $request->dias_reserva,
                        'Precio_habitacion_reserva' => $request->Precio_habitacion_reserva,
                        'PrecioRestante_reserva' => $request->PrecioRestante_reserva,
                        'Total_reserva' => $request->Total_reserva,
                        'CategoriaHabitacion_reserva' => $request->CategoriaHabitacion_reserva, 
                        'user_id' => Auth::user()->id,
                        'CamaraHotelera' => $request->CamaraHotelera,
                    ]);

                    $reservahabitacion->detallereservas()->createMany($results);
                    //return response()->json($reservahabitacion);
                    DB::commit();
                } catch (\Throwable $th) {
                DB::rollback();
                notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ', 'No Se Pudo Registrar ');
                return redirect()->route('hostal.habitacion.index');
            }
                notify()->success('Se Registro Correctamente ') or notify()->success('Se Registro Correctamente ', 'Se Registro Correctamente ');
                return redirect()->route('hostal.habitacion.index');
        }
    }

    public function DetalleHospedaje(Habitacion $habitacion){
        $countries = file_get_contents(public_path('/json/countries.json'));
        $countries = json_decode($countries, true);

        $data = file_get_contents(public_path('/json/departamentos.json'));
        $departamentos = json_decode($data, true);

        $hospedajes = HospedajeHabitacion::select('*')
                    ->where('hospedaje_habitacions.habitacion_id','=',$habitacion->id)
                    ->latest('hospedaje_habitacions.id')->first();

        $hospedaje_habitacion_id = $hospedajes->id;

        $invitados = HospedajeHabitacionInvitado::select('*')
            ->where('hospedaje_habitacion_invitados.hospedaje_habitacion_id', '=', $hospedaje_habitacion_id)
            ->get();
        
        $TotalSumatoriaInvitados = HospedajeHabitacionInvitado::select('*')
            ->where('hospedaje_habitacion_invitados.hospedaje_habitacion_id', '=', $hospedaje_habitacion_id)
            ->where('hospedaje_habitacion_invitados.Pagado', '=', 'NO')
            ->get();
        
        $total_invitados = $TotalSumatoriaInvitados->sum('invitado_Total');

        $contInvitado = DetalleHospedajeInvitado::where('hospedaje_habitacion_invitado_id','=', $hospedaje_habitacion_id)->count();

        $detalleshospedajes = DetalleHospedajeHabitacion::get();
        $productos = ProductoHostal::get();
        $servicios = ServicioHostal::get();
        $detalleservicios = DetalleServicioHostal::select('*')
        ->join('servicio_hostals','servicio_hostals.id','detalle_servicio_hostals.servicio_hostals_id')
        ->orderBy('detalle_servicio_hostals.FechaRegistro_servicio','asc')
        ->get();
        $detalleproductos = DetalleProducto::select('hospedaje_habitacions.id as hospedaje_habitacions',
                                                    'producto_hostals.Nombre_producto','producto_hostals.Precio_producto',
                                                    'detalle_productos.cantidad', 'detalle_productos.Tipo_pagado')
        ->join('hospedaje_habitacions','hospedaje_habitacions.id','detalle_productos.hospedaje_habitacion_id')
        ->join('producto_hostals','producto_hostals.id','detalle_productos.producto_id')
        ->get();        

        $full_hospedajes = HospedajeHabitacionInvitado::select('*')->get();

        foreach($full_hospedajes as $full_hospedaje) {
            $detalles = DetalleHospedajeInvitado::select('cliente_hostals.*')
            ->join('cliente_hostals', 'cliente_hostals.id', '=', 'detalle_hospedaje_invitados.cliente_id')
            ->where('detalle_hospedaje_invitados.hospedaje_habitacion_invitado_id', '=', $full_hospedaje->id)
            ->get();
        
            $full_hospedaje->detalles = $detalles;
        }                
    
        $clientes = ClienteHostal::get();
                
        $ultimo_registro = Caja::latest('id')->first();        
        
        //return response()->json($full_hospedaje);
        return view('hostal.habitaciones.DetalleHospedaje', compact('total_invitados','full_hospedajes','clientes','contInvitado','departamentos','ultimo_registro','invitados','detalleservicios','detalleproductos','productos','habitacion','servicios','hospedajes','detalleshospedajes'))->with('countries', $countries);
    }

    public function DetalleReserva(Habitacion $habitacion){
        $countries = file_get_contents(public_path('/json/countries.json'));
        $countries = json_decode($countries, true);

        $data = file_get_contents(public_path('/json/departamentos.json'));
        $departamentos = json_decode($data, true);
        
        $reservas = ReservaHabitacion::select('*')
        ->where('reserva_habitacions.habitacion_id','=',$habitacion->id)
        ->latest('reserva_habitacions.id')->first();
        
        $reserva_habitacion_id = $reservas->id;

        $contInvitado = ReservaHabitacionInvitado::where('reserva_habitacion_id','=', $reservas->id)->count();

        $detallereservas = DetalleReservaHabitacion::get();
        $clientes = ClienteHostal::get();
        $productos = ProductoHostal::get();
        $servicios = ServicioHostal::get();
        $detalleservicios = DetalleServicioHostal::select('*')
        ->join('servicio_hostals','servicio_hostals.id','detalle_servicio_hostals.servicio_hostals_id')
        ->orderBy('detalle_servicio_hostals.FechaRegistro_servicio','asc')
        ->get();
        $detalleproductos = DetalleProducto::select('reserva_habitacions.id as reserva_habitacions',
                                                    'producto_hostals.Nombre_producto','producto_hostals.Precio_producto',
                                                    'detalle_productos.cantidad', 'detalle_productos.Tipo_pagado')
        ->join('reserva_habitacions','reserva_habitacions.id','detalle_productos.reserva_habitacion_id')
        ->join('producto_hostals','producto_hostals.id','detalle_productos.producto_id')
        ->get();
        
        $invitados = ReservaHabitacionInvitado::get();

        $TotalSumatoriaInvitados = ReservaHabitacionInvitado::select('*')
            ->where('reserva_habitacion_invitados.reserva_habitacion_id', '=', $reserva_habitacion_id)
            ->where('reserva_habitacion_invitados.Pagado', '=', 'NO')
            ->get();
        
        $total_invitados = $TotalSumatoriaInvitados->sum('invitado_Total');

        $detalleinvitados = DetalleReservaInvitado::get();

        $full_reservas = ReservaHabitacionInvitado::select('*')->get();

        foreach($full_reservas as $full_reserva) {
            $detalles = DetalleReservaInvitado::select('cliente_hostals.*')
            ->join('cliente_hostals', 'cliente_hostals.id', '=', 'detalle_reserva_invitados.cliente_id')
            ->where('detalle_reserva_invitados.reserva_habitacion_invitado_id', '=', $full_reserva->id)
            ->get();
        
            $full_reserva->detalles = $detalles;
        }  

        $ultimo_registro = Caja::latest('id')->first();

        //return response()->json($total_invitados);
        return view('hostal.habitaciones.DetalleReserva', compact('total_invitados','full_reservas','ultimo_registro','contInvitado','departamentos','invitados','detalleservicios','detalleproductos','productos','habitacion','servicios','reservas','detallereservas','clientes'))->with('countries', $countries);
    }
    
    public function ConcluirReserva(ReservaHabitacion $reservahabitacion){
        //return response()->json($reservahabitacion->habitacion_id);
        $estadohabitacion = Habitacion:: findOrFail($reservahabitacion->habitacion_id);
        if($estadohabitacion->Estado_habitacion == 'DISPONIBLE'){
            $estadohabitacion->Estado_habitacion = 'OCUPADO';
            $estadohabitacion->Reserva_habitacion ='SI';
            $estadohabitacion->save();
    
            $estadoreserva = ReservaHabitacion:: findOrFail($reservahabitacion->id);
            $estadoreserva->Estado_reserva = 'INGRESO';
            $estadoreserva->save();
            notify()->success('LA RESERVA SE CONCLUYO') or notify()->success('LA RESERVA SE CONCLUYO ⚡️', 'RESERVA CONCLUIDO');
            return redirect()->route('hostal.habitacion.index');
        }else{
            notify()->error('No Se Puede Concluir La Reserva Por Que Aun No FInalizaste La Anterior RESERVA') or notify()->error('No Se Puede Concluir La Reserva Por Que Aun No FInalizaste La Anterior RESERVA ⚡️', 'RESERVA NO CONCLUIDO');
            return redirect()->route('hostal.habitacion.index');
        }
        //return response()->json($estadoreserva);
        
    }

    public function ProductoStore(Habitacion $habitacion, Request $request){
        //return response()->json($request);
        try {
            DB::beginTransaction();
                if($request->hospedaje_habitacion_id != null){
                    $user = Auth::user();
                    foreach($request->datosIdProducto as $key=>$insert){
                        $results[] = array("producto_id" => $request->datosIdProducto[$key],
                                            "cantidad" => $request->cantidad[$key],
                                            "Precio_venta" => $request->datosPrecioProduct[$key],
                                            "Tipo_pagado" => $request->datosTipoPagoProduct[$key],
                                            "Stock_producto" =>  $request->datosStockProduct[$key],
                                            'user_id' => Auth::user()->id);
                                $newstock = $request->datosStockProduct[$key]-$request->cantidad[$key];
                                $productos = ProductoHostal:: findOrFail($request->datosIdProducto[$key]);
                                $productos->Stock_producto = $newstock;
                                $productos->save();
                                if($request->datosTipoPagoProduct[$key] == 'Por Paga'){
                                    $newtotalproducto = HospedajeHabitacion:: findOrFail($request->hospedaje_habitacion_id); 
                                    $newtotalproducto->TotalProducto += $request->total;
                                    $newtotalproducto->save();
                                }                
                    }

                    $hospedaje = HospedajeHabitacion::findOrFail($request->hospedaje_habitacion_id);
                    $hospedaje->detalleproductos()->createMany($results);
                }else{
                    $user = Auth::user();
                    foreach($request->datosIdProducto as $key=>$insert){                        
                        $results[] = array("producto_id" => $request->datosIdProducto[$key],
                                            "cantidad" => $request->cantidad[$key],
                                            "Precio_venta" => $request->datosPrecioProduct[$key],
                                            "Tipo_pagado" => $request->datosTipoPagoProduct[$key],
                                            "Stock_producto" =>  $request->datosStockProduct[$key],
                                            'user_id' => Auth::user()->id);
                                $newstock = $request->datosStockProduct[$key]-$request->cantidad[$key];
                                $productos = ProductoHostal:: findOrFail($request->datosIdProducto[$key]);
                                $productos->Stock_producto = $newstock;
                                $productos->save();
                                if($request->datosTipoPagoProduct[$key] == 'Por Paga'){
                                    $newtotalproducto = ReservaHabitacion:: findOrFail($request->reserva_habitacion_id); 
                                    $newtotalproducto->TotalProducto_reserva += $request->total;
                                    $newtotalproducto->save();
                                }
                        }
                    $reserva = ReservaHabitacion::findOrFail($request->reserva_habitacion_id);
                    $reserva->detalleproductoreservas()->createMany($results);
                }
            DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ', 'No Se Pudo Registrar ');
            return redirect()->back();
        }
            notify()->success('Se Registro Correctamente ') or notify()->success('Se Registro Correctamente ', 'Se Registro Correctamente ');
            return redirect()->back();
    }
    

    public function ServicioStore(Habitacion $habitacion, Request $request){
        //return response()->json($request);
        try {
            DB::beginTransaction();
                $data = request()->validate([
                    'hospedaje_habitacion_id' => 'nullable',
                    'reserva_habitacion_id' => 'nullable',
                    'user_id' => 'required',
                    'servicio_hostals_id' => 'required',
                    'FechaRegistro_servicio_extra' => 'required',
                    'cantidad_servicio_extra' => 'required',
                    'Precio_servicio_extra' => 'required',
                    'Incluye_servicio' => 'required',
                ]);

                if($request->Incluye_servicio == 'NO' && $request->hospedaje_habitacion_id != null){
                    $newtotalservicio = $request->TotalServicio_extra;
                    $servicios = HospedajeHabitacion:: findOrFail($request->hospedaje_habitacion_id);
                    $servicios->TotalServicio += $newtotalservicio;
                    $servicios->save();
                    $datodetalleservicio = DetalleServicioHostal::create([
                        'hospedaje_habitacion_id' => $data['hospedaje_habitacion_id'],
                        'user_id' => $data['user_id'],
                        'servicio_hostals_id' => $data['servicio_hostals_id'],
                        'FechaRegistro_servicio' => $data['FechaRegistro_servicio_extra'],
                        'cantidad_servicio' => $data['cantidad_servicio_extra'],
                        'Precio_servicio' => $data['Precio_servicio_extra'],
                        'Incluye_servicio' => $data['Incluye_servicio'],
                    ]);
                    
                }else{
                    $newtotalservicio = $request->TotalServicio_extra;
                    $servicios = ReservaHabitacion:: findOrFail($request->reserva_habitacion_id);
                    $servicios->TotalServicio_reserva += $newtotalservicio;
                    $servicios->save();
                    $datodetalleservicio = DetalleServicioHostal::create([
                        'reserva_habitacion_id' => $data['reserva_habitacion_id'],
                        'user_id' => $data['user_id'],
                        'servicio_hostals_id' => $data['servicio_hostals_id'],
                        'FechaRegistro_servicio' => $data['FechaRegistro_servicio_extra'],
                        'cantidad_servicio' => $data['cantidad_servicio_extra'],
                        'Precio_servicio' => $data['Precio_servicio_extra'],
                        'Incluye_servicio' => $data['Incluye_servicio'],
                    ]);
                    
                }
                
            DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ', 'No Se Pudo Registrar ');

            return redirect()->back();
        }
            notify()->success('Se Registro Correctamente ') or notify()->success('Se Registro Correctamente ', 'Se Registro Correctamente ');
            return redirect()->back();
    }

    public function ServicioDesayuno(Habitacion $habitacion, Request $request){
        //return response()->json($request);
        try {
            DB::beginTransaction();
                    $hospedaje_habitacion_id = DetalleServicioHostal::create($request->all());
            DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ', 'No Se Pudo Registrar ');
            return redirect()->back();
        }
            notify()->success('Se Registro Correctamente ') or notify()->success('Se Registro Correctamente ', 'Se Registro Correctamente ');
            return redirect()->back();
    }

    public function ServicioDesayunoReserva(Habitacion $habitacion, Request $request){
        try {
            DB::beginTransaction();
                    $hospedaje_habitacion_id = DetalleServicioHostal::create($request->all());
            DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ', 'No Se Pudo Registrar ');
            return redirect()->back();
        }
            notify()->success('Se Registro Correctamente ') or notify()->success('Se Registro Correctamente ', 'Se Registro Correctamente ');
            return redirect()->back();
    }

    public function ServicioLimpieza(Habitacion $habitacion, Request $request){
        //return response()->json($request);
        try {
            DB::beginTransaction();
                    $hospedaje_habitacion_id = DetalleServicioHostal::create($request->all());
            DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ', 'No Se Pudo Registrar ');
            return redirect()->back();
        }
            notify()->success('Se Registro Correctamente ') or notify()->success('Se Registro Correctamente ', 'Se Registro Correctamente ');
            return redirect()->back();
    }

    public function updatehabitacion(Request $request, $id){
        ///actualizar valores de la habitacion 
        //return response()->json($request->payment);
        $Datoshabitacion = Habitacion:: findOrFail($id);
        $Datoshabitacion->Estado_habitacion = 'LIMPIEZA';
        $Datoshabitacion->Reserva_habitacion ='NO';
        $Datoshabitacion->save();
    
        if($request->Hospedaje_id != null){
            ///actualizar valores del hospedaje
            $Datoshospedaje = HospedajeHabitacion:: findOrFail($request->Hospedaje_id); 
            $Datoshospedaje->TotalGeneralHospedaje = $request->TotalGeneralHospedaje2;
            $Datoshospedaje->TipoPago = $request->payment;
            $Datoshospedaje->save();            

            if($request->payment == 'EFECTIVO'){
                /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
                $hospedajes = HospedajeHabitacion::join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')
                ->findOrfail($request->Hospedaje_id);
                $DetalleCajas = DetalleCaja::create([
                'caja_id' => $request->caja_id,
                'codigo_caja_id' => 2,
                'articulo_caja_id' => 71,
                'Articulo_description' => 'Hospedaje de la '.
                                    $hospedajes->Nombre_habitacion.' una '.
                                    $hospedajes->CategoriaHabitacion.' se quedo '.
                                    number_format($hospedajes->dias_hospedarse, 0, '.', '').' dias.',
                'Ingreso' => $request->TotalGeneralHospedaje2,
                'Egreso' => 0.00,
                'Fecha_registro' => Carbon::now('America/La_Paz'),
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
                /*FIN TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
            }elseif($request->payment == 'TARJETA'){
                /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
                $hospedajes = HospedajeHabitacion::join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')
                ->findOrfail($request->Hospedaje_id);
                $DetalleCajas = DetalleCaja::create([
                'caja_id' => $request->caja_id,
                'codigo_caja_id' => 3,
                'articulo_caja_id' => 71,
                'Articulo_description' => 'Hospedaje de la '.
                                    $hospedajes->Nombre_habitacion.' una '.
                                    $hospedajes->CategoriaHabitacion.' se quedo '.
                                    number_format($hospedajes->dias_hospedarse, 0, '.', '').' dias.',
                'Ingreso' => $request->TotalGeneralHospedaje2,
                'Egreso' => 0.00,
                'Fecha_registro' => Carbon::now('America/La_Paz'),
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
                /*FIN TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
            }else{
                /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
                $hospedajes = HospedajeHabitacion::join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')
                ->findOrfail($request->Hospedaje_id);
                $DetalleCajas = DetalleCaja::create([
                'caja_id' => $request->caja_id,
                'codigo_caja_id' => 4,
                'articulo_caja_id' => 71,
                'Articulo_description' => 'Hospedaje de la '.
                                    $hospedajes->Nombre_habitacion.' una '.
                                    $hospedajes->CategoriaHabitacion.' se quedo '.
                                    number_format($hospedajes->dias_hospedarse, 0, '.', '').' dias '.'De la Cuenta '.$request->Ndeposito,
                'Ingreso' => $request->TotalGeneralHospedaje2,
                'Egreso' => 0.00,
                'Fecha_registro' => Carbon::now('America/La_Paz'),
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
                /*FIN TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
            }
            //return redirect()->route('hostal.habitacion.hospedajePDF', $Datoshospedaje);
            notify()->success('HOSPEDAJE CONCLUIDO') or notify()->success(' HOSPEDAJE SE CONCLUYO ⚡️', 'HOSPEDAJE CONCLUIDO');
            return redirect()->route('hostal.habitacion.HospedajesLista');
        }else{
            ///actualizar valores de reserva
            $Datosreserva = ReservaHabitacion:: findOrFail($request->Reserva_id); 
            $Datosreserva->TotalGeneralHospedaje_reserva = $request->TotalGeneralHospedaje2;
            $Datosreserva->Estado_reserva = 'CONCLUIDO';
            $Datosreserva->save();

            if($request->payment == 'EFECTIVO'){
                /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
                $reservas = ReservaHabitacion::join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
                ->findOrfail($request->Reserva_id);
                $DetalleCajas = DetalleCaja::create([
                'caja_id' => $request->caja_id,
                'codigo_caja_id' => 2,
                'articulo_caja_id' => 72,
                'Articulo_description' => 'Reserva de la '.
                                    $reservas->Nombre_habitacion.' una '.
                                    $reservas->CategoriaHabitacion_reserva.' se quedo '.
                                    number_format($reservas->dias_reserva, 0, '.', '').' dias.',
                'Ingreso' => $request->TotalGeneralHospedaje2,
                'Egreso' => 0.00,
                'Fecha_registro' => Carbon::now('America/La_Paz'),
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
                /*FIN TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
            }elseif($request->payment == 'TARJETA'){
                /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
                $reservas = ReservaHabitacion::join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
                ->findOrfail($request->Reserva_id);
                $DetalleCajas = DetalleCaja::create([
                'caja_id' => $request->caja_id,
                'codigo_caja_id' => 3,
                'articulo_caja_id' => 72,
                'Articulo_description' => 'Reserva de la '.
                                    $reservas->Nombre_habitacion.' una '.
                                    $reservas->CategoriaHabitacion_reserva.' se quedo '.
                                    number_format($reservas->dias_reserva, 0, '.', '').' dias.',
                'Ingreso' => $request->TotalGeneralHospedaje2,
                'Egreso' => 0.00,
                'Fecha_registro' => Carbon::now('America/La_Paz'),
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
                /*FIN TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
            }else{
                /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
                        $reservas = ReservaHabitacion::join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
                        ->findOrfail($request->Reserva_id);
                $DetalleCajas = DetalleCaja::create([
                    'caja_id' => $request->caja_id,
                    'codigo_caja_id' => 4,
                    'articulo_caja_id' => 72,
                    'Articulo_description' => 'Reserva de la '.
                                            $reservas->Nombre_habitacion.' una '.
                                            $reservas->CategoriaHabitacion_reserva.' se quedo '.
                                            number_format($reservas->dias_reserva, 0, '.', '').' dias '.'De la Cuenta '.$request->Ndeposito,
                    'Ingreso' => $request->TotalGeneralHospedaje2,
                    'Egreso' => 0.00,
                    'Fecha_registro' => Carbon::now('America/La_Paz'),
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
                /*FIN TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
            }
            
            //Aquí abrimos la nueva ventana con la ruta del pdf
            notify()->success('LA RESERVA SE CONCLUYO') or notify()->success('LA RESERVA SE CONCLUYO ⚡️', 'RESERVA CONCLUIDO');
            return redirect()->route('hostal.habitacion.ReservasLista');
        }
    }
    

    public function autocompletehostalcliente(Request $request) {
        $data = ClienteHostal::select(
            "Documento_cliente",
            DB::raw("CONCAT(Documento_cliente, ' - ', Nombre_cliente, IFNULL(CONCAT(' ', Apellido_cliente), '')) AS value"),
            "Nombre_cliente",
            "Apellido_cliente",
            "id",
            "Nacionalidad_cliente",
            "Profesion_cliente",
            "Edad_cliente",
            "EstadoCivil_cliente"
        )
        ->where(function ($query) use ($request) {
            $query->where('Documento_cliente', 'LIKE', '%'. $request->get('search'). '%')
                  ->orWhere('Nombre_cliente', 'LIKE', '%'. $request->get('search'). '%')
                  ->orWhere('Apellido_cliente', 'LIKE', '%'. $request->get('search'). '%');
        })
        ->get();
    
        return response()->json($data);
    }


    public function autocompletehostalproducto(Request $request){
        $data = ProductoHostal::select("Nombre_producto as value", "Nombre_producto","id",
                                      "Precio_producto","Stock_producto")
                    ->where('Nombre_producto', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    //funcion privada para controlar que no se repita las fechas si existe reserva
    private function FechasReservado($request){
        $reservado = false;
        $reserva_inicial = ReservaHabitacion::where('habitacion_id',$request->habitacion_id)
        ->where('ingreso_reserva','<=',$request->ingreso_reserva)
        ->where('salida_reserva','>=',$request->salida_reserva)
        ->count();
        if($reserva_inicial > 0){
            $reservado = true;
        }

        $reserva_final = ReservaHabitacion::where('habitacion_id',$request->habitacion_id)
        ->where('ingreso_reserva','<=',$request->ingreso_reserva)
        ->where('salida_reserva','>=',$request->salida_reserva)
        ->count();
        if($reserva_final > 0){
            $reservado = true;
        }

        $reserva_inicial_final = ReservaHabitacion::where('habitacion_id',$request->habitacion_id)
        ->where('ingreso_reserva','>=',$request->ingreso_reserva)
        ->where('salida_reserva','<=',$request->salida_reserva)
        ->count();
        if($reserva_inicial_final > 0){
            $reservado = true;
        }

        return $reservado;
    }

    public function fullcalendar(){
        $countries = file_get_contents(public_path('/json/countries.json'));
        $countries = json_decode($countries, true);

        $data = file_get_contents(public_path('/json/departamentos.json'));
        $departamentos = json_decode($data, true);

        $habitaciones = Habitacion::select('*')
                    ->where('habitacions.Estado_habitacion','DISPONIBLE')
                    ->get(); 
        $all_events = ReservaHabitacion::select('habitacions.id',
                                                'habitacions.Nombre_habitacion',
                                                'reserva_habitacions.ingreso_reserva',
                                                'reserva_habitacions.salida_reserva')
        ->join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
        ///->where('habitacions.Estado_habitacion','OCUPADO')
        ->get();
        $events = [];
        foreach($all_events as $event){
            $color = null;
            switch ($event->Nombre_habitacion) {
                case 'Habitacion #1':
                    $color = '#641E16';
                    break;
                case 'Habitacion #2':
                    $color = '#512E5F';
                    break;
                case 'Habitacion #3':
                    $color = '#1B4F72';
                    break;
                case 'Habitacion #4':
                    $color = '#ff0000';
                    break;
                case 'Habitacion #5':
                    $color = '#0B5345';
                    break;
                case 'Habitacion #6':
                    $color = '#0000ff';
                    break;
                case 'Habitacion #7':
                    $color = '#7D6608';
                    break;
                case 'Habitacion #8':
                    $color = '#7B7D7D';
                    break;
                case 'Habitacion #9':
                    $color = '#1B2631';
                    break;
                case 'Habitacion #10':
                    $color = '#D98880';
                    break;
                case 'Habitacion #11':
                    $color = '#D2B4DE';
                    break;
                case 'Habitacion #12':
                    $color = '#00FBFF';
                    break;
                case 'Habitacion #13':
                    $color = '#E59866';
                    break;
                case 'Habitacion #14':
                    $color = '#ABB2B9';
                    break;
                case 'Habitacion #15':
                    $color = '#717D7E';
                    break;
                case 'Habitacion #16':
                    $color = '#E74C3C';
                    break;
                case 'Habitacion #17':
                    $color = '#3498DB';
                    break;
                case 'Habitacion #18':
                    $color = '#DC7500';
                    break;
                case 'Habitacion #19':
                    $color = '#E14D2A';
                    break;
                case 'Habitacion #20':
                    $color = '#F56EB3';
                    break;
                case 'Habitacion #21':
                    $color = '#8B7E74';
                    break;
                case 'Habitacion #22':
                    $color = '#ff0000';
                    break;
                case 'Habitacion #23':
                    $color = '#00ff00';
                    break;
                case 'Habitacion #24':
                    $color = '#2192FF';
                    break;
                default:
                    $color = '#000000'; // negro
            }
            $events[] = [
                'id' => $event->id,
                'title' => $event->Nombre_habitacion,
                'start' => $event->ingreso_reserva,
                'end' => $event->salida_reserva,
                'color' => $color,
                'description' => 'Etiam a odio eget enim aliquet laoreet. Vivamus auctor nunc ultrices varius lobortis.'
            ];
        }
        //return response()->json($events);
        return view('hostal.habitaciones.fullcalendar',compact('events','habitaciones','departamentos'))->with('countries', $countries);
    }

    public function ServiciosIncluidos(){
        $habitaciones = Habitacion::select('habitacions.id','habitacions.Nombre_habitacion')
                                    ->get(); 
        $all_serves = DetalleServicioHostal::select('habitacions.id as habID','reserva_habitacions.id as res_id',
                                                    'Detalle_servicio_hostals.id','servicio_hostals.Nombre_servicio',
                                                    'Detalle_servicio_hostals.FechaRegistro_servicio','servicio_hostals.Nombre_servicio')
        ->join('servicio_hostals','servicio_hostals.id','Detalle_servicio_hostals.servicio_hostals_id')
        ->join('reserva_habitacions','reserva_habitacions.id','Detalle_servicio_hostals.reserva_habitacion_id')
        ->join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')        
        //->where('habitacions.id','reserva_habitacions.habitacion_id')
        ->get();

        $all_servehospedajes = DetalleServicioHostal::select('habitacions.id as habID','hospedaje_habitacions.id as res_id',
                                                    'Detalle_servicio_hostals.id','servicio_hostals.Nombre_servicio',
                                                    'Detalle_servicio_hostals.FechaRegistro_servicio','servicio_hostals.Nombre_servicio')
        ->join('servicio_hostals','servicio_hostals.id','Detalle_servicio_hostals.servicio_hostals_id')
        ->join('hospedaje_habitacions','hospedaje_habitacions.id','Detalle_servicio_hostals.hospedaje_habitacion_id')        
        ->join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')
        ->get();

        $hbts = [];
        foreach($habitaciones as $habitacione){
            $hbts[] = [
                'id' => $habitacione->id,
                'title' => $habitacione->Nombre_habitacion,
                'resourceId' => $habitacione->id,
            ];
        }
        $serves = [];
        foreach($all_serves as $serve){
            $color = null;
            switch ($serve->Nombre_servicio) {
                case 'DESAYUNO':
                    $color = '#d62828';
                    break;
                case 'LIMPIEZA':
                    $color = '#0d47a1';
                    break;
                default:
                    $color = '#ff9f1c'; // negro
            }
            $serves[] = [
                $title = $serve->Nombre_servicio,
                'id' => $serve->id,
                'title' => $title,
                'start' => $serve->FechaRegistro_servicio,
                'end' => $serve->FechaRegistro_servicio,
                'resourceId' => $serve->habID,
                'color' => $color,
            ];
        }

        $servehospedajes = [];
        foreach($all_servehospedajes as $servehospedaje){
            $color = null;
            switch ($servehospedaje->Nombre_servicio) {
                case 'DESAYUNO':
                    $color = '#d62828';
                    break;
                case 'LIMPIEZA':
                    $color = '#0d47a1';
                    break;
                default:
                    $color = '#ff9f1c'; // negro
            }
            $servehospedajes[] = [
                $title = $servehospedaje->Nombre_servicio,
                'id' => $servehospedaje->id,
                'title' => $title,
                'start' => $servehospedaje->FechaRegistro_servicio,
                'end' => $servehospedaje->FechaRegistro_servicio,
                'resourceId' => $servehospedaje->habID,
                'color' => $color,
            ];
        }

        //return response()->json($hbts);
        return view('hostal.habitaciones.ServiciosIncluidos',compact('serves','servehospedajes','habitaciones','hbts'));
    }

    public function CancelarReserva(Request $request, ReservaHabitacion $reservahabitacion){
        //return response()->json($reservahabitacion->habitacion_id);
        $estadoreserva = ReservaHabitacion:: findOrFail($reservahabitacion->id);
        $estadoreserva->Estado_reserva = 'ELIMINADO';
        $estadoreserva->EliminadoIngreso = $estadoreserva->ingreso_reserva;
        $estadoreserva->EliminadoSalida = $estadoreserva->salida_reserva;
        $estadoreserva->ingreso_reserva = 'NULL';
        $estadoreserva->salida_reserva = 'NULL';
        $estadoreserva->save();
        notify()->success('Su reserva se cancelo correctamente') or notify()->success('Se Registro Correctamente ', 'Su reserva se cancelo correctamente');        
        return redirect()->route('hostal.habitacion.index');
    }

    public function ReservasLista(){
        $reservashabitaciones = ReservaHabitacion::get();
        $detallereservashabitaciones = DetalleReservaHabitacion::get();
        $clienteshostal = ClienteHostal::get();
        $habitaciones = Habitacion::get();
        //return response()->json($detallereservashabitaciones);
        return view('hostal.habitaciones.ReservasLista',compact('habitaciones','reservashabitaciones','clienteshostal','detallereservashabitaciones'));
    }

    public function hospedajePDF(HospedajeHabitacion $hospedajehabitacion){
        //return response()->json($tipoclientes);
        $hospedajes  = HospedajeHabitacion::join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')
        ->join('detalle_hospedaje_habitacions','hospedaje_habitacions.id','detalle_hospedaje_habitacions.hospedaje_habitacion_id')
        ->findOrFail($hospedajehabitacion->id);

        $detallehospedajes = DetalleHospedajeHabitacion::select('*')
                            ->where('detalle_hospedaje_habitacions.hospedaje_habitacion_id', $hospedajehabitacion->id)
                            ->get();

        $NDesayuno = DetalleServicioHostal::select('*')
                        ->join('servicio_hostals','servicio_hostals.id','detalle_servicio_hostals.servicio_hostals_id')
                        ->where('servicio_hostals.Nombre_servicio', 'DESAYUNO')
                        ->where('detalle_servicio_hostals.hospedaje_habitacion_id', $hospedajehabitacion->id)
                        ->count();

        $NLimpieza = DetalleServicioHostal::select('*')
                        ->join('servicio_hostals','servicio_hostals.id','detalle_servicio_hostals.servicio_hostals_id')
                        ->where('servicio_hostals.Nombre_servicio', 'LIMPIEZA')
                        ->where('detalle_servicio_hostals.hospedaje_habitacion_id', $hospedajehabitacion->id)
                        ->count();
    
        $NProducto = DetalleProducto::select('*')
                        ->join('producto_hostals','producto_hostals.id','detalle_productos.producto_id')
                        ->where('detalle_productos.hospedaje_habitacion_id', $hospedajehabitacion->id)
                        ->count();

        $detalleservicios = DetalleServicioHostal::select('*')
                        ->join('servicio_hostals','servicio_hostals.id','detalle_servicio_hostals.servicio_hostals_id')
                        ->get();

        $clientes = ClienteHostal::get();

        $productos = DetalleProducto::select('*')
                    ->join('producto_hostals','producto_hostals.id','detalle_productos.producto_id')
                    ->get();

        $pdf = PDF::loadView('hostal.habitaciones.hospedajePDF',compact('NProducto','detallehospedajes','NDesayuno','NLimpieza','productos','hospedajes','detalleservicios','clientes'))
            ->setPaper('portrait');
       //return view('hostal.habitaciones.hospedajePDF',compact('NProducto','detallehospedajes','NDesayuno','NLimpieza','productos','hospedajes','detalleservicios','clientes',));
        return $pdf->stream('hospedaje'.time().$hospedajehabitacion->id.'.pdf');
    }

    public function reservaPDF(ReservaHabitacion $reservahabitacion){
        //return response()->json($reservahabitacion);
        //return response()->json($tipoclientes);
        $reservas  = ReservaHabitacion::join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
        ->join('detalle_reserva_habitacions','reserva_habitacions.id','detalle_reserva_habitacions.reserva_habitacion_id')
        ->findOrFail($reservahabitacion->id);

        $detallereservas = DetalleReservaHabitacion::select('*')
                            ->where('detalle_reserva_habitacions.reserva_habitacion_id', $reservahabitacion->id)
                            ->get();

        $NDesayuno = DetalleServicioHostal::select('*')
                        ->join('servicio_hostals','servicio_hostals.id','detalle_servicio_hostals.servicio_hostals_id')
                        ->where('servicio_hostals.Nombre_servicio', 'DESAYUNO')
                        ->where('detalle_servicio_hostals.reserva_habitacion_id', $reservahabitacion->id)
                        ->count();

        $NLimpieza = DetalleServicioHostal::select('*')
                        ->join('servicio_hostals','servicio_hostals.id','detalle_servicio_hostals.servicio_hostals_id')
                        ->where('servicio_hostals.Nombre_servicio', 'LIMPIEZA')
                        ->where('detalle_servicio_hostals.reserva_habitacion_id', $reservahabitacion->id)
                        ->count();

        $NProducto = DetalleProducto::select('*')
                        ->join('producto_hostals','producto_hostals.id','detalle_productos.producto_id')
                        ->where('detalle_productos.reserva_habitacion_id', $reservahabitacion->id)
                        ->count();

        $detalleservicios = DetalleServicioHostal::select('*')
                        ->join('servicio_hostals','servicio_hostals.id','detalle_servicio_hostals.servicio_hostals_id')
                        ->get();

        $clientes = ClienteHostal::get();


        $productos = DetalleProducto::select('*')
                    ->join('producto_hostals','producto_hostals.id','detalle_productos.producto_id')
                    ->get();
        
        //return view('hostal.habitaciones.reservaPDF',compact('NProducto','detallereservas','reservas','NDesayuno','NLimpieza','detalleservicios','clientes',,'productos'));            
        $pdf = PDF::loadView('hostal.habitaciones.reservaPDF',compact('NProducto','detallereservas','reservas','NDesayuno','NLimpieza','detalleservicios','clientes','productos'))
                ->setPaper('portrait');
        
        return $pdf->stream('hospedaje'.time().$reservahabitacion->id.'.pdf');
    }

    ///traer todas las habitaciones
    public function get_rooms_by_id(Request $request){
        if ($request->ajax()) {
            $habitacions = Habitacion::findOrFail($request->habitacion_id);
            return response()->json($habitacions);
        }
    }

    public function checkAvailability(Request $request){
        // Recoger las fechas de inicio y fin de la reserva
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Consultar todas las reservas existentes
        $reservations = ReservaHabitacion::all();

        // Bandera para indicar si las fechas están disponibles
        $is_available = true;

        // Revisar cada reserva existente
        foreach ($reservations as $reservation) {
        // Comparar fechas de inicio y fin de la reserva existente con la reserva que se está intentando realizar
        if (($start_date >= $reservation->ingreso_reserva && $start_date <= $reservation->salida_reserva) || ($end_date >= $reservation->ingreso_reserva && $end_date <= $reservation->salida_reserva)) {
            // Si hay solapamiento, cambiar la bandera a false
            $is_available = false;
            break;
        }
        }

        // Devolver respuesta a la llamada a la API
        return response()->json([
        'success' => $is_available
        ]);
    }

    public function pruebas(){
        $hospedajes = ArticuloCaja::get();
        //return response()->json($events);
        return view('hostal.habitaciones.pruebas',compact('hospedajes'));
    }

    public function HospedajesLista(){
        //return response()->json($tipoclientes);
        $hospedajehabitaciones = HospedajeHabitacion::orderBy('id', 'desc')->paginate(10);
        $detallehospedajehabitaciones = DetalleHospedajeHabitacion::get();
        $clienteshostal = ClienteHostal::get();
        $habitaciones = Habitacion::get();
        //dd($hospedajes);
        //return response()->json($hospedajes);
        
        return view('hostal.habitaciones.HospedajesLista',compact('hospedajehabitaciones','detallehospedajehabitaciones','clienteshostal','habitaciones'));
    }

    public function FullReportes(){               
        return view('hostal.habitaciones.FullReportes');
    }
    
    public function CambiarReserva(Request $request){
        //return response()->json($request);
        $reserva = ReservaHabitacion::findOrFail($request->id_res);
        $reserva->habitacion_id = $request->habitacion_id;
        $reserva->save();
        //toast('Mensaje de éxito', 'success');
        //return response()->json($reserva);
        return back();        
    }

    public function CambiarHospedaje(Request $request){
        $hospedaje = HospedajeHabitacion::join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')
                                    ->findOrFail($request->id_hospedaje);
        
        $hospedaje->salida_hospedaje = $request->salidainput;        

        $habitacionhospedaje = Habitacion::findOrFail($hospedaje->habitacion_id);
        $habitacionhospedaje->Estado_habitacion = 'DISPONIBLE';

        $actualizahospedaje = HospedajeHabitacion::findOrFail($request->id_hospedaje);
        $actualizahospedaje->habitacion_id = $request->habitacion_id;        

        $habitacion = Habitacion::findOrFail($request->habitacion_id);
        $habitacion->Estado_habitacion = 'OCUPADO';

        $habitacionhospedaje->save();
        $actualizahospedaje->save();
        $habitacion->save();
        $hospedaje->save();
        return back();         
    }

    public function CambiarReservaDatos(Request $request){
        //return response()->json($request);
        $reserva = ReservaHabitacion::join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
                                    ->findOrFail($request->id_res);
                                          

        $habitacionreserva = Habitacion::findOrFail($reserva->habitacion_id);
        $habitacionreserva->Estado_habitacion = 'DISPONIBLE';
        $habitacionreserva->Reserva_habitacion = 'NO';

        $actualizareserva = ReservaHabitacion::findOrFail($request->id_res);
        $actualizareserva->habitacion_id = $request->habitacion_id;
        

        $habitacion = Habitacion::findOrFail($request->habitacion_id);
        $habitacion->Estado_habitacion = 'OCUPADO';
        $habitacion->Reserva_habitacion = 'SI';

        $habitacionreserva->save();
        $actualizareserva->save();
        $habitacion->save();

        return back();        
    }

    public function storepruebas(Request $request){
        $url = $request->input('ubicacion');
        $data = array();
        $data['url'] = $url;
        
        // Extract latitude and longitude
        preg_match('/@([-\d\.]+),([-\d\.]+)/', $url, $matches);
        $data['latitude'] = $matches[1];
        $data['longitude'] = $matches[2];
        
        // Extract address
        $parts = explode('/', $url);
        $address = urldecode($parts[5]);
        $data['address'] = $address;
        
        // Extract zoom
        preg_match('/z\/data=(.*)/', $url, $matches);
        $data['zoom'] = $matches[1];
        
        return $data;
    } 

    public function registrarcliente(Request $request){    
        return response()->json($request);
    }  
    
    public function storeclienteinvitadoReserva(Request $request){
        try {
            DB::beginTransaction();
                foreach($request->cliente_id as $key=>$insert){
                    $results[] = array("cliente_id" => $request->cliente_id[$key]);
                }

                $reservas = ReservaHabitacionInvitado::create([
                    'reserva_habitacion_id' => $request->Reserva_id,
                    'invitado_ingreso_reserva' => $request->invitado_ingreso_reserva,
                    'invitado_salida_reserva' => $request->invitado_salida_reserva,
                    'invitado_Total' => $request->invitado_Total,
                    'Pagado' => $request->pagado,
                ]);

                $reservas->detallereservainvitados()->createMany($results);

                DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ', 'No Se Pudo Registrar ');
            return back(); 
        }
            notify()->success('Se Registro Correctamente ') or notify()->success('Se Registro Correctamente ', 'Se Registro Correctamente ');
            return back(); 
    }

    public function storeclienteinvitadoHospedaje(Request $request){
        try {
            DB::beginTransaction();
                foreach($request->cliente_id as $key=>$insert){
                    $results[] = array("cliente_id" => $request->cliente_id[$key]);
                }

                $hospedajes = HospedajeHabitacionInvitado::create([
                    'hospedaje_habitacion_id' => $request->hospedaje_id,
                    'invitado_ingreso_hospedaje' => $request->invitado_ingreso_hospedaje,
                    'invitado_salida_hospedaje' => $request->invitado_salida_hospedaje,
                    'invitado_Total' => $request->invitado_Total,
                    'Pagado' => $request->pagado,
                ]);

                $hospedajes->detallehospedajeinvitados()->createMany($results);

                DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ', 'No Se Pudo Registrar ');
            return back(); 
        }
            notify()->success('Se Registro Correctamente ') or notify()->success('Se Registro Correctamente ', 'Se Registro Correctamente ');
            return back(); 
    }

    public function CambiarEstadoLimpieza(Request $request){
        //return response()->json($request);
        $Datoshabitacion = Habitacion:: findOrFail($request->id_hab);
        $Datoshabitacion->Estado_habitacion = 'DISPONIBLE';
        $Datoshabitacion->Reserva_habitacion ='NO';
        $Datoshabitacion->save();
            
        //Aquí abrimos la nueva ventana con la ruta del pdf
        notify()->success('LA LIMPIEZA SE A CONCLUIDO HABITACION DISPONIBLE') or notify()->success('LA LIMPIEZA SE A CONCLUIDO HABITACION DISPONIBLE ⚡️', 'LA LIMPIEZA SE A CONCLUIDO HABITACION DISPONIBLES');
        return back(); 
    }

    
    public function CamaraHotelera(Request $request){
        
        $xdd = HospedajeHabitacion::first();

        // Obtener los hospedajes con el atributo ingreso_hospedaje como objeto Carbon
        $hospedajes = HospedajeHabitacion::join('detalle_hospedaje_habitacions', 'detalle_hospedaje_habitacions.hospedaje_habitacion_id', '=', 'hospedaje_habitacions.id')
                                        ->join('cliente_hostals', 'cliente_hostals.id', '=', 'detalle_hospedaje_habitacions.cliente_id')
                                        ->where('hospedaje_habitacions.CamaraHotelera','=','si')
                                        ->get()
                                        ->map(function ($hospedaje) {
                                            $hospedaje->ingreso_hospedaje = Carbon::parse($hospedaje->ingreso_hospedaje);
                                            $hospedaje->salida_hospedaje = Carbon::parse($hospedaje->salida_hospedaje);
                                            return $hospedaje;
                                        });

        // Obtener los reservas con el atributo ingreso_hospedaje como objeto Carbon
        $reservas = ReservaHabitacion::join('detalle_reserva_habitacions', 'detalle_reserva_habitacions.reserva_habitacion_id', '=', 'reserva_habitacions.id')
                                        ->join('cliente_hostals', 'cliente_hostals.id', '=', 'detalle_reserva_habitacions.cliente_id')
                                        ->where('reserva_habitacions.CamaraHotelera','=','si')
                                        ->get()
                                        ->map(function ($reserva) {
                                            $reserva->ingreso_reserva = Carbon::parse($reserva->ingreso_reserva);
                                            $reserva->salida_reserva = Carbon::parse($reserva->salida_reserva);
                                            return $reserva;
                                        });

        $fecha_actual = Carbon::now();
        $primer_dia_del_ano = Carbon::parse($xdd->ingreso_hospedaje)->startOfDay();
        $dias_por_mes = [];

        while ($primer_dia_del_ano->lte($fecha_actual)) {
            $mes = $primer_dia_del_ano->format('F');
            $dia = $primer_dia_del_ano->format('d/m/Y');
            
            // Obtener los clientes que ingresaron en la habitación en la fecha especificada
            $ingresaron = [];
            foreach ($hospedajes as $hospedaje) {
                if ($hospedaje->ingreso_hospedaje->format('Y-m-d') == $primer_dia_del_ano->format('Y-m-d')) {
                    $ingresaron[] = [
                        'Nombre' => $hospedaje->Nombre_cliente,
                        'Apellido' => $hospedaje->Apellido_cliente,
                        'Documento' => $hospedaje->Documento_cliente,
                        'Nacionalidad' => $hospedaje->Nacionalidad_cliente,
                        'Profesion' => $hospedaje->Profesion_cliente,
                        'Edad' => $hospedaje->Edad_cliente,
                        'Estado' => $hospedaje->EstadoCivil_cliente,
                        'Procedencia' => $hospedaje->procedencia_hospedaje,
                        'Habitacion' => $hospedaje->habitacion_id,
                    ];
                }
            }
            foreach ($reservas as $reserva) {
                if ($reserva->ingreso_reserva->format('Y-m-d') == $primer_dia_del_ano->format('Y-m-d')) {
                    $ingresaron[] = [
                        'Nombre' => $reserva->Nombre_cliente,
                        'Apellido' => $reserva->Apellido_cliente,
                        'Documento' => $reserva->Documento_cliente,
                        'Nacionalidad' => $reserva->Nacionalidad_cliente,
                        'Profesion' => $reserva->Profesion_cliente,
                        'Edad' => $reserva->Edad_cliente,
                        'Estado' => $reserva->EstadoCivil_cliente,
                        'Procedencia' => $reserva->procedencia_reserva,
                        'Habitacion' => $reserva->habitacion_id,
                    ];
                }
            }
            
           // Obtener los clientes que están en la habitación en la fecha especificada
            $quedaron = [];
            foreach ($hospedajes as $hospedaje) {
                if ($hospedaje->ingreso_hospedaje->format('Y-m-d') <= $primer_dia_del_ano->format('Y-m-d') &&
                    ($hospedaje->salida_hospedaje->format('Y-m-d') > $primer_dia_del_ano->format('Y-m-d') || is_null($hospedaje->salida_hospedaje))) {
                    $quedaron[] =[
                        'Nombre' => $hospedaje->Nombre_cliente,
                        'Apellido' => $hospedaje->Apellido_cliente,
                        'Documento' => $hospedaje->Documento_cliente,
                        'Nacionalidad' => $hospedaje->Nacionalidad_cliente,
                        'Profesion' => $hospedaje->Profesion_cliente,
                        'Edad' => $hospedaje->Edad_cliente,
                        'Estado' => $hospedaje->EstadoCivil_cliente,
                        'Procedencia' => $hospedaje->procedencia_hospedaje,
                        'Habitacion' => $hospedaje->habitacion_id,
                    ];
                }
            }
            foreach ($reservas as $reserva) {
                if ($reserva->ingreso_reserva->format('Y-m-d') <= $primer_dia_del_ano->format('Y-m-d') &&
                    ($reserva->salida_reserva->format('Y-m-d') > $primer_dia_del_ano->format('Y-m-d') || is_null($reserva->salida_reserva))) {
                    $quedaron[] = [
                        'Nombre' => $reserva->Nombre_cliente,
                        'Apellido' => $reserva->Apellido_cliente,
                        'Documento' => $reserva->Documento_cliente,
                        'Nacionalidad' => $reserva->Nacionalidad_cliente,
                        'Profesion' => $reserva->Profesion_cliente,
                        'Edad' => $reserva->Edad_cliente,
                        'Estado' => $reserva->EstadoCivil_cliente,
                        'Procedencia' => $reserva->procedencia_reserva,
                        'Habitacion' => $reserva->habitacion_id,
                    ];
                }
            }

            // Remover los hospedajes que también ingresaron en la misma fecha
            foreach ($ingresaron as $ingresado) {
                $key = array_search($ingresado, $quedaron);
                if ($key !== false) {
                    unset($quedaron[$key]);
                }
            }
            

            // Obtener los clientes que salieron de la habitación en la fecha especificada
            $salieron = [];
            foreach ($hospedajes as $hospedaje) {
                if ($hospedaje->salida_hospedaje->format('Y-m-d') == $primer_dia_del_ano->format('Y-m-d') && $hospedaje->TotalGeneralHospedaje > 0 ) {
                    $salieron[] = [
                        'Nombre' => $hospedaje->Nombre_cliente,
                        'Apellido' => $hospedaje->Apellido_cliente,
                        'Documento' => $hospedaje->Documento_cliente,
                        'Nacionalidad' => $hospedaje->Nacionalidad_cliente,
                        'Profesion' => $hospedaje->Profesion_cliente,
                        'Edad' => $hospedaje->Edad_cliente,
                        'Estado' => $hospedaje->EstadoCivil_cliente,
                        'Procedencia' => $hospedaje->procedencia_hospedaje,
                        'Habitacion' => $hospedaje->habitacion_id,
                    ];
                }
            }
            foreach ($reservas as $reserva) {
                if ($reserva->salida_reserva->format('Y-m-d') == $primer_dia_del_ano->format('Y-m-d') && $reserva->TotalGeneralHospedaje_reserva > 0 ) {
                    $salieron[] = [
                        'Nombre' => $reserva->Nombre_cliente,
                        'Apellido' => $reserva->Apellido_cliente,
                        'Documento' => $reserva->Documento_cliente,
                        'Nacionalidad' => $reserva->Nacionalidad_cliente,
                        'Profesion' => $reserva->Profesion_cliente,
                        'Edad' => $reserva->Edad_cliente,
                        'Estado' => $reserva->EstadoCivil_cliente,
                        'Procedencia' => $reserva->procedencia_reserva,
                        'Habitacion' => $reserva->habitacion_id,
                    ];
                }
            }

            $dias_por_mes[$mes][$dia] = [
                'ingresaron' => $ingresaron,
                'quedaron' => $quedaron,
                'salieron' => $salieron,
            ];
            
            $primer_dia_del_ano->addDay();
        }

        //return response()->json($dias_por_mes);
        //return view('hostal.habitaciones.CamaraHotelera', compact('hospedajes', 'dias_por_mes','detallehospedajes'));

         $pdf = PDF::loadView('hostal.habitaciones.CamaraHotelera',compact('hospedajes', 'dias_por_mes'))
                     ->setPaper('portrait');
        
        return $pdf->stream('hospedaje'.time().'.pdf');
    }

    public function NovedadProblema(Request $request){
        //return response()->json($fechas);
        return view('hostal.habitaciones.NovedadProblema');
    }

    public function StoreNovedadProblema(Request $request){
        return  response()->json($request);
        return redirect()->route('hostal.habitacion.index');
    }
}