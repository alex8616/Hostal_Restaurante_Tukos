<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reserva;
use App\Models\DetalleReserva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


class AmbienteController extends Controller
{

    public function index(){
        $ambientes = Ambiente::orderBy('id', 'desc')->get();
        return view('admin.ambiente.index',compact('ambientes'));
    }

    public function CrearReserva(Ambiente $ambiente){
        return view('admin.ambiente.CrearReserva', compact('ambiente'));
    }

    public function store(Request $request){
    try {
        DB::beginTransaction();
        $data = request()->validate([
            'Nombre_Ambiente' => 'required|unique:ambientes'
           ]);

        $datosambiente = Ambiente::create([
            'Nombre_Ambiente' => $data['Nombre_Ambiente'],
        ]);
        DB::commit();
                } catch (\Throwable $th) {
                DB::rollback();
                notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar', 'No Se Pudo Registrar');
                return back();            
            }
                notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente', 'Se Registro Correctamente');
                return back();
        }

    
        public function reserva(Ambiente $ambiente,Request $request){
        $reservas = Reserva::select('*')
        ->where('reservas.ambiente_id', '=', $ambiente->id)
        ->orderBy('reservas.id', 'desc')
        ->paginate(5);
        //return response()->json($reservas);
        return view('admin.ambiente.reserva',compact('ambiente','reservas'));
        //return response()->json($ambiente);
    }

    public function reservastore(Request $request){
        $reservado = $this->horarioReservado($request);
        if($reservado){
            notify()->error('error', 'Noce Puede Registrar Por Que Ya Hay Una RESERVA En La Hora Seleccionada') or notify()->error('error', 'Noce Puede Registrar Por Que Ya Hay Una RESERVA En La Hora Seleccionada');
            return back(); 
        }else{
            //return response()->json($request);
            if($request->pago1 == 'Deposito'){
                try {
                    DB::beginTransaction();
                    $user = Auth::user();
                    $reserva = Reserva::create($request->all() + [
                        'user_id' => Auth::user()->id,
                        'fecha' => Carbon::now('America/La_Paz'),
                    ]);        
                    DB::commit();
                        } catch (\Throwable $th) {
                        DB::rollback();
                        notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar', 'No Se Pudo Registrar');
                        return back();
                    }
                        notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente', 'Se Registro Correctamente');
                        return back();    
            }else{
            try {
                DB::beginTransaction();
                $user = Auth::user();
                foreach($request->descripcion as $key=>$insert){
                    $results[] = array("descripcion_refrigerio" => $request->descripcion[$key],
                                        "cantidad_refrigerio" => $request->cantidad[$key],
                                        "precio_refrigerio" => $request->precio_refrigerio[$key]);
                }
    
                $user = Auth::user();
                $reserva = Reserva::create($request->all() + [
                    'user_id' => Auth::user()->id,
                    'fecha' => Carbon::now('America/La_Paz'),
                ]);
    
                $reserva->detallereservas()->createMany($results);
                DB::commit();
                    } catch (\Throwable $th) {
                    DB::rollback();
                    notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar', 'No Se Pudo Registrar');
                    return back();
                }
                    notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente', 'Se Registro Correctamente');
                    return back();    
            }
        }
    }
    
    public function show(Ambiente $ambiente){
       
    }

    public function edit(Ambiente $ambiente){
        return view('admin.ambiente.index', compact('ambiente'));
        //return response()->json($ambiente);
    }

    public function updatereserva(Request $request, $id){
    try {
        DB::beginTransaction();
        $datosreservas = request()->except(['_token', '_method']);
        Reserva::where('id', '=', $id)->update($datosreservas);
        $reserva = Reserva::findOrFail($id);
        DB::commit();
    } catch (\Throwable $th) {
        DB::rollback();
        notify()->error('No Se Pudo Actualizar .. ') or notify()->error('No Se Pudo Actualizar', 'NO Actualizado');
        return back();
    }
        notify()->success('Se Actualizo La Informacion correctamente') or notify()->success('Se Actualizo La Informacion correctamente', 'Actualizado Correctamente');
        return back();
    }

    public function destroy(Ambiente $ambiente){
        $item = $ambiente->reservas()->count();
        if ($item > 0) {
            return redirect()->back()->with('error','No se puede eliminar, Por Que Tiene RESERVACIONES registradas.');
        }
        $ambiente->delete();
        return redirect()->route('admin.ambiente.index')->with('delete', 'ok');
    }

    public function destroyreserva(Reserva $reserva){
        $reserva->delete();
        return back()->with('delete', 'ok');
    }

    private function horarioReservado($request){
        $reservado = false;
        $reserva_inicial = Reserva::where('fecha',$request->fecha)
        ->where('ambiente_id',$request->ambiente_id)
        ->where('hora_inicio','<=',$request->hora_inicio)
        ->where('hora_fin','>=',$request->hora_inicio)
        ->count();
        if($reserva_inicial > 0){
            $reservado = true;
        }

        $reserva_final = Reserva::where('fecha',$request->fecha)
        ->where('ambiente_id',$request->ambiente_id)
        ->where('hora_inicio','<=',$request->hora_fin)
        ->where('hora_fin','>=',$request->hora_fin)
        ->count();
        if($reserva_final > 0){
            $reservado = true;
        }

        $reserva_inicial_final = Reserva::where('fecha',$request->fecha)
        ->where('ambiente_id',$request->ambiente_id)
        ->where('hora_inicio','>=',$request->hora_inicio)
        ->where('hora_fin','<=',$request->hora_fin)
        ->count();
        if($reserva_inicial_final > 0){
            $reservado = true;
        }

        return $reservado;
    }

    public function pdf(Reserva $reserva){

        $ambientes = Ambiente::get();
        $detallereservas = DetalleReserva::get();
        $pdf = PDF::loadView('admin.ambiente.pdf',compact('reserva','ambientes','detallereservas'))
                    ->setOptions(['defaultFont' => 'sans-serif'])
                    ->setPaper(array(0,0,500,1000), 'portrait');
        return $pdf->stream('Reporte_de_reserva'.$reserva.'.pdf');
        //return response()->json($reserva);
    }
    
    public function ExportPDF(Ambiente $ambiente){
        $reservas = Reserva::get();
        $detallereservas = DetalleReserva::get();
        $pdf = PDF::loadView('admin.ambiente.ExportPDF', compact('reservas','ambiente','detallereservas'));
        return $pdf->stream('Reporte_de_reserva'.time().'.pdf');
    }

    public function rangefecha(Request $request){
        $desde = $request->get('desdefecha');
        $hasta = $request->get('hastafecha');
        $ambiente_id = $request->get('ambiente_id');
        //2022-11-29 12:01:24
        $from = Carbon::parse($desde)->format('Y-m-d');
        $to = Carbon::parse($hasta)->format('Y-m-d'); 
        $data = [];
        $data = Reserva::join('users as u', 'u.id', 'reservas.user_id')
                ->select('reservas.*', 'u.name as user')
                ->whereBetween('reservas.fecha', [$from, $to])
                ->where('reservas.ambiente_id',$ambiente_id)
                ->get();
        $ambientes = Ambiente::get();    
        $detallereservas = DetalleReserva::get();
        $pdf = PDF::loadView('admin.ambiente.reportefechas',compact('ambientes','detallereservas','data','desde','hasta','ambiente_id'));        
        return $pdf->stream('reportehoras'.time().'pdf');
        return response()->json($data);
    }

    public function reportegeneralfecha(Request $request){
        $desde = $request->get('desdefecha');
        $hasta = $request->get('hastafecha');
        //2022-11-29 12:01:24
        $from = Carbon::parse($desde)->format('Y-m-d');
        $to = Carbon::parse($hasta)->format('Y-m-d'); 
        $data = [];
        $data = Reserva::join('users as u', 'u.id', 'reservas.user_id')
                ->select('reservas.*', 'u.name as user')
                ->whereBetween('reservas.fecha', [$from, $to])
                ->get();
        $ambientes = Ambiente::get();    
        $detallereservas = DetalleReserva::get();
        $pdf = PDF::loadView('admin.ambiente.reportegeneralfecha',compact('ambientes','detallereservas','data','desde','hasta'));        
        return $pdf->stream('reportehoras'.time().'pdf');
        //return response()->json($request);
    }

    public function reportegeneral(){
        $ambientes = Ambiente::get();
        $reservas = Reserva::get();
        $detallereservas = DetalleReserva::get();
        $pdf = PDF::loadView('admin.ambiente.reportegeneral', compact('ambientes','reservas','detallereservas'));
        return $pdf->stream('Reporte_de_reserva'.time().'.pdf');
        //return response()->json($ambientes);
    }
    
}
