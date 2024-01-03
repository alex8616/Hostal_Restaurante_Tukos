<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Cliente;
use App\Models\Combo;
use App\Models\Festivale;
use App\Models\RegistroFestivale;
use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\DetalleCaja;
use App\Models\DetalleFestivale;
use App\Models\Mesa;
use App\Models\MesaFestivale;
use App\Models\ReservaFestivale;
use Barryvdh\DomPDF\Facade\Pdf;

    class FestivaleController extends Controller
{
    public function index(){
        $festivales = Festivale::orderBy('id', 'desc')->get();

        foreach ($festivales as $festival) {
            $festival->total = $festival->registrofestivales->sum('total');
        }

        ///return response()->json($festivales);
        return view('admin.festival.index',compact('festivales'));       
    }

    public function registrar(Festivale $festival,Request $request){
        $clientes = Cliente::get();
        $combos = Combo::select('combos.id','combos.Nombre_combo','combos.Precio_combo','combos.Nombre_categoria','combos.festival_id')
                        ->where('combos.Nombre_categoria', '=', 'combo')
                        ->orWhere('combos.Nombre_categoria', '=', 'gaseosas')
                        ->get();
        $mesas = MesaFestivale::where('festivale_id',$festival->id)->where('estado','FALSE')->get();
        $comanda = RegistroFestivale::where('festivale_id',$festival->id)->latest('id')->first();
        $comandaspdf = RegistroFestivale::where('festivale_id',$festival->id)->latest('id')->first();
        $ultimo_registro = Caja::latest('id')->first();
        $clientes = Cliente::get();
        $festivales = RegistroFestivale::where('festivale_id',$festival->id)->get();
        $detallefestivales = DetalleFestivale::get();
        $count = RegistroFestivale::where('festivale_id',$festival->id)->count();
        $countreserva = ReservaFestivale::where('festivale_id',$festival->id)->count();

        $activeTab = 'comandas'; // Cambia esto según la pestaña que deseas resaltar
        return view('admin.festival.registrar',compact('mesas','countreserva','activeTab','count','festival','ultimo_registro','combos','clientes','comandaspdf','festivales','detallefestivales'));
    }
    
    public function storefestival(Request $request){
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $nombre = Festivale::findOrFail($request->festival_id);

            $festival = RegistroFestivale::create($request->all() + [
                'festivale_id' => $request->festival_id,
                'user_id' => Auth::user()->id,
                'fecha_venta' => Carbon::now('America/La_Paz'),
                'mesa_id' => $request->mesa_id,
            ]);

            $detalledid = $festival->id;

            foreach($request->id_plato as $key=>$insert){
                $festival = DetalleFestivale::create([
                    'registrofestival_id' => $detalledid,
                    'combo_id' => $request->id_plato[$key],
                    'cantidad' => $request->cantidad[$key],
                    'precio_venta' => $request->Precio_plato[$key],
                    'comentario' => $request->comentario[$key]
                ]);
            }

            /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
            $DetalleCajas = DetalleCaja::create([
                'caja_id' => $request->caja_id,
                'codigo_caja_id' => 1,
                'articulo_caja_id' => 24,
                'Articulo_description' => $nombre->nombre_festival.' MAS DETALLE ID: '.' '.$detalledid,
                'Ingreso' => $request->total,
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

            DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ⚡️', 'No Se Pudo Registrar');
            return back();
        }
            notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente ⚡️', 'Se Registro Correctamente');
            //return response()->json($request->all());
            return back();
    }
    
    public function pdf(RegistroFestivale $festival){
        $detallefestivales = DetalleFestivale::get();
        //return response()->json($detallefestivales);
        $pdf = PDF::loadView('admin.festival.pdf', compact('festival','detallefestivales'))->setOptions(['defaultFont' => 'sans-serif'])->setPaper(array(0,0,320,500), 'portrait');;
        return $pdf->stream('Reporte_de_venta'.$festival->id.'pdf');
    }

    public function reportefestival(Request $request){
        $idrequest = $request->festival_id;
        $festival = Festivale::findOrFail($idrequest);
        $total = $festival->registrofestivales->sum('total');
        $total2 = $festival->reservafestivales->sum('Total_reserva');       
        $detallefestivales = DetalleFestivale::get();

        $cantidaddetalleFestivales = DetalleFestivale::select('combo_id', DB::raw('SUM(cantidad) as total_cantidad'))
                                    ->with('combo')
                                    ->where(function ($query) use ($festival) {
                                        $query->whereHas('registrofestival', function ($q) use ($festival) {
                                            $q->where('festivale_id', $festival->id);
                                        })->orWhereHas('reservafestival', function ($q) use ($festival) {
                                            $q->where('festivale_id', $festival->id);
                                        });
                                    })
                                    ->groupBy('combo_id')
                                    ->get();
    

        //return response()->json($cantidaddetalleFestivales);
        $pdf = PDF::loadView('admin.festival.reporte', compact('total2','idrequest','festival','total','detallefestivales','cantidaddetalleFestivales'));
        return $pdf->stream('Reporte_de_festival.pdf');
    }

    public function Reservas(){
        $mesas = Mesa::get();
        return view('admin.festival.realizar_reservas',compact('mesas'));
    }

    public function RealizarReserva(Festivale $festival,Request $request){
        $mesas = MesaFestivale::where('festivale_id',$festival->id)->where('estado','FALSE')->get();
        //return response()->json($mesas);
        return view('admin.festival.RealizarReserva',compact('mesas','festival'));
    }

    public function reservadata(Festivale $festival){
        $reservalDate = ReservaFestivale::join('mesa_festivales','mesa_festivales.id','reserva_festivales.mesa_festivale_id')
                        ->where('reserva_festivales.festivale_id',$festival->id)->get();
        return datatables()->of($reservalDate)->toJson(); 
    }

    public function reservastore(Request $request){
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $reserva = ReservaFestivale::create([
                'festivale_id' => $request->festival_id,
                'mesa_festivale_id' => $request->mesa_id,
                'user_id' => Auth::user()->id,
                'Nombre_reserva' => $request->Nombre_reserva,
                'Fecha_registro' => Carbon::now('America/La_Paz'),
                'Cantidad_persona' => $request->Cantidad_persona,
                'Adeltanto_reserva' => $request->Adeltanto_reserva,
                'Deuda_reserva' => $request->Adeltanto_reserva,
                'Total_reserva' => 0,
                'tipopago' => 'EFECTIVO',
                'estado' => 'FALSE',
                'Celular_reserva' => $request->Celular_reserva,
                'Hora_reserva' => $request->Hora_reserva,
            ]);

            $mesas = MesaFestivale::findOrFail($request->mesa_id);
            $mesas->estado = 'TRUE';
            $mesas->save();                        
            
            DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ⚡️', 'No Se Pudo Registrar');
            return back();
        }
            notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente ⚡️', 'Se Registro Correctamente');
            //return response()->json($request->all());
            return back();
    }

    public function edit(Request $request, $id){
        $reserva = ReservaFestivale::findOrFail($id);
        return response()->json($reserva);
    }
    
    public function updatereservafestival(Request $request, $id){
        $reservaupdate = ReservaFestivale::findOrFail($id);
        $reservaupdate->Nombre_reserva = $request->Edit_Nombre_reserva;
        $reservaupdate->Cantidad_persona = $request->Edit_Cantidad_persona;
        $reservaupdate->Adeltanto_reserva = $request->Edit_Adeltanto_reserva;
        $reservaupdate->mesa_festivale_id = $request->Edit_mesa_id;
        $reservaupdate->save();
        return response()->json($request);
    }
    
    public function reservaspdf(Request $request){
        $mesas = MesaFestivale::where('festivale_id',$request->festival_id)->get();
        $festival = Festivale::findOrFail($request->festival_id);
        $reservas = ReservaFestivale::where('festivale_id',$request->festival_id)->get();
        //return response()->json($festival);
        $pdf = PDF::loadView('admin.festival.reservaspdf',  compact('reservas','festival','mesas'));
        return $pdf->stream('Reporte_de_venta'.$festival->id.'pdf');
    }

    public function concluirreserva(Festivale $festival, Request $request){
        $reservas = ReservaFestivale::where('festivale_id',$festival->id)->where('estado','FALSE')->get();
        $combos = Combo::select('combos.id','combos.Nombre_combo','combos.Precio_combo','combos.Nombre_categoria','combos.festival_id')
                        ->where('combos.Nombre_categoria', '=', 'combo')
                        ->orWhere('combos.Nombre_categoria', '=', 'gaseosas')
                        ->get();

        $comandaspdf = ReservaFestivale::where('festivale_id',$festival->id)->where('estado','TRUE')->latest('id')->first();
        $ultimo_registro = Caja::latest('id')->first();
        $reservafestivales = ReservaFestivale::where('festivale_id',$festival->id)->where('estado','TRUE')->get();
        $detallefestivales = DetalleFestivale::get();
        $count = ReservaFestivale::where('festivale_id',$festival->id)->where('estado','TRUE')->count();
        $countreserva = ReservaFestivale::where('festivale_id',$festival->id)->where('estado','TRUE')->count();
        // Lógica para determinar la pestaña activa actual
        $activeTab = 'reservas'; // Cambia esto según la pestaña que deseas resaltar
        //return response()->json($detallefestivales);
        return view('admin.festival.concluirreserva', compact('reservas','count', 'festival', 'ultimo_registro', 'combos', 'comandaspdf', 'reservafestivales', 'detallefestivales', 'activeTab','countreserva'));
    }

    public function obtenerDatosReserva(Request $request){
        $reservaId = $request->input('reserva_id');
        $reserva = ReservaFestivale::join('mesa_festivales','reserva_festivales.mesa_festivale_id','mesa_festivales.id')
                    ->find($reservaId);
        if ($reserva) {
            $datosReserva = [
                'Cantidad_persona' => $reserva->Cantidad_persona,
                'mesa_id' => $reserva->Nombre_mesa,
                'Adeltanto_reserva' => $reserva->Adeltanto_reserva,
                'Total_reserva' => $reserva->Total_reserva,
                'pagado' => $reserva->pagado
            ];

            return response()->json($datosReserva);
        } else {
            return response()->json(['error' => 'La reserva no existe'], 404);
        }
    }

    public function storereservafestival(Request $request){
        //return response()->json($request);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $reservafestival = ReservaFestivale::findOrFail($request->reserva_id);
            $reservafestival->Total_reserva = $request->total;
            $reservafestival->estado = 'TRUE';
            $reservafestival->save();

            foreach($request->id_plato as $key=>$insert){
                $festival = DetalleFestivale::create([
                    'reservafestival_id' => $reservafestival->id,
                    'combo_id' => $request->id_plato[$key],
                    'cantidad' => $request->cantidad[$key],
                    'precio_venta' => $request->Precio_plato[$key],
                    'comentario' => $request->comentario[$key]
                ]);
            }

            $festival = Festivale::findOrFail($request->festival_id);
            $detalledid = $reservafestival->id;

            /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
            $DetalleCajas = DetalleCaja::create([
                'caja_id' => $request->caja_id,
                'codigo_caja_id' => 1,
                'articulo_caja_id' => 24,
                'Articulo_description' => $festival->nombre_festival.' MAS DETALLE ID: '.' '.$detalledid,
                'Ingreso' => $request->total,
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

            DB::commit();
            } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar ⚡️', 'No Se Pudo Registrar');
            return back();
        }
            notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente ⚡️', 'Se Registro Correctamente');
            //return response()->json($request->all());
            return back();
    }

    public function pdfreserva(ReservaFestivale $festival){
        $detallefestivales = DetalleFestivale::get();
        //return response()->json($detallefestivales);
        $pdf = PDF::loadView('admin.festival.pdfreserva', compact('festival','detallefestivales'))->setOptions(['defaultFont' => 'sans-serif'])->setPaper(array(0,0,320,500), 'portrait');;
        return $pdf->stream('Reporte_de_venta'.$festival->id.'pdf');
    }

    public function festivalstore(Request $request){
        try {
            DB::beginTransaction();

            $festival = Festivale::create([
                'nombre_festival' => $request->nombre_festival,
                'descripcion_festival' => $request->descripcion_festival,
                'fecha_festival' => Carbon::now('America/La_Paz'),
            ]);

            if ($request->hasFile('img_festival')) {
                $imagePath = $request->file('img_festival')->store('public/festival_images');
                $festival->foto_festival = $imagePath;
                $festival->save();
            }

            $i = 20;
            for ($i; $i > 0; $i--) {
                $mesas = MesaFestivale::create([
                    'festivale_id' => $festival->id,
                    'Nombre_mesa' => 'Mesa #' . $i,
                ]);
            }

           DB::commit();
            notify()->success('Se Registró Correctamente ⚡️', 'Se Registró Correctamente');
            return back();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar ⚡️', 'No Se Pudo Registrar');
            return back();
        }
    }


    public function croquismap(Request $request){
        /*$mesas = ReservaFestivale::join('mesa_festivales','reserva_festivales.mesa_id','mesa_festivales.id')
                                ->where('reserva_festivales.festivale_id',$request->festival_id)
                                ->get();*/
        $mesas = MesaFestivale::with('reservafestivales.mesa')
                                ->where('festivale_id', $request->festival_id)
                                ->get();
                            
        $allmesas = MesaFestivale::where('festivale_id',$request->festival_id)->get();                                
        //return response()->json($mesas);
        //$mesas = MesaFestivale::where('estado','TRUE')->where('festivale_id',$request->festival_id)->get();
        return view('admin.festival.croquismap',compact('mesas','allmesas'));
    }

    public function guardarPosiciones(Request $request){
        $mesas = $request->input('mesas');
        foreach ($mesas as $mesaData) {
            $mesa = MesaFestivale::find($mesaData['id']);

            if ($mesa) {
                $mesa->posicion_x = $mesaData['posicion_x'];
                $mesa->posicion_y = $mesaData['posicion_y'];
                $mesa->save();
            }
        }
        $mesas = MesaFestivale::where('estado','TRUE')->get();
        return response()->json(['mesas' => $mesas]);
    }
    
    public function obtenerPosiciones(Request $request){
        $posiciones = MesaFestivale::where('estado','TRUE')->get();
        return response()->json($posiciones);
    }

    public function addreservafestival(Request $request){
        $reservas = ReservaFestivale::findOrFail($request->id_reserva);
        
        $detallereseva = DetalleFestivale::create([
            'reservafestival_id' => $reservas->id,
            'combo_id' => $request->id_plato,
            'cantidad' => $request->cantidad,
            'precio_venta' => $request->Precio_plato,
            'comentario' => $request->comentario,
        ]);

        $sumtotal = $request->cantidad * $request->Precio_plato;

        $reservas->Total_reserva += $sumtotal;
        $reservas->save();
        notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente ⚡️', 'Se Registro Correctamente');

        return back();
    }

    public function addfestival(Request $request){
        $registro = RegistroFestivale::findOrFail($request->id_registro);
        
        $detallereseva = DetalleFestivale::create([
            'registrofestival_id' => $registro->id,
            'combo_id' => $request->id_plato,
            'cantidad' => $request->cantidad,
            'precio_venta' => $request->Precio_plato,
            'comentario' => $request->comentario,
        ]);

        $sumtotal = $request->cantidad * $request->Precio_plato;

        $registro->total += $sumtotal;
        $registro->save();
        notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente ⚡️', 'Se Registro Correctamente');

        return back();
    }
}