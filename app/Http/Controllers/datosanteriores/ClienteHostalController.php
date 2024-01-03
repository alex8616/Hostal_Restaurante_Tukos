<?php

namespace App\Http\Controllers;

use App\Models\ClienteHostal;
use App\Models\DetalleHospedajeHabitacion;
use App\Models\DetalleReservaHabitacion;
use App\Models\HospedajeHabitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteHostalController extends Controller
{
    public function index(){
        $clientes = ClienteHostal::get();
        $countries = file_get_contents(public_path('/json/countries.json'));
        $countries = json_decode($countries, true);

        $data = file_get_contents(public_path('/json/departamentos.json'));
        $departamentos = json_decode($data, true);
        //return response()->json($clientes);
        return view('hostal.clientes.index',compact('clientes','departamentos'))->with('countries', $countries);
    }

    public function store(Request $request){
        $empData = [
            'Nombre_cliente' => $request->Nombre_cliente,
            'Apellido_cliente' => $request->Apellido_cliente, 
            'Documento_cliente' => $request->Documento_cliente, 
            'Nacionalidad_cliente' => $request->Nacionalidad_cliente,  
            'Profesion_cliente' => $request->Profesion_cliente,
            'Edad_cliente' => $request->Edad_cliente,
            'EstadoCivil_cliente' => $request->EstadoCivil_cliente,
            'Celular_cliente' => $request->Celular_cliente,
        ];
    
        $cliente = ClienteHostal::create($empData);
    
        if ($request->hasFile('imagenes')) {
            $nombres = [];
            foreach ($request->file('imagenes') as $imagen) {
                $nombreArchivo = $request->Documento_cliente . '_' . $imagen->getClientOriginalName();
                $ruta = $imagen->storeAs('public/uploads', $nombreArchivo);
                $nombres[] = $nombreArchivo;
            }
            $cliente->imagenes = json_encode($nombres);
            $cliente->save();
        }
    
        return response()->json([
            'status' => 200,
            'cliente' => $cliente
        ]);
    }
     

    public function storelist(Request $request){
        try {
            DB::beginTransaction();
            $empData = ['Nombre_cliente' => $request->Nombre_cliente, 
                    'Documento_cliente' => $request->Documento_cliente, 
                    'Nacionalidad_cliente' => $request->Nacionalidad_cliente,  
                    'Profesion_cliente' => $request->Profesion_cliente,
                    'Edad_cliente' => $request->Edad_cliente,
                    'EstadoCivil_cliente' => $request->EstadoCivil_cliente,
                    'Celular_cliente' => $request->Celular_cliente];
		    ClienteHostal::create($empData);
            DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar⚡️', 'Cliente NO Registrado');
                return redirect()->route('hostal.ClienteHostal.index');
            }
                notify()->success('Se registró correctamente') or notify()->success('Se registró correctamente ⚡️', 'Registrado Correctamente');
                return redirect()->route('hostal.ClienteHostal.index');
    }

    public function InformacionCliente(ClienteHostal $clienteHostal){
        //return response()->json($id);
        $hospedajes = DetalleHospedajeHabitacion::select('*')
                    ->join('hospedaje_habitacions','hospedaje_habitacions.id','detalle_hospedaje_habitacions.hospedaje_habitacion_id')
                    ->join('cliente_hostals','cliente_hostals.id','detalle_hospedaje_habitacions.cliente_id')
                    ->join('habitacions','habitacions.id','hospedaje_habitacions.habitacion_id')                    
                    ->where('detalle_hospedaje_habitacions.cliente_id',$clienteHostal->id)
                    ->paginate(5);
                    //->get();

        $reservas = DetalleReservaHabitacion::select('*')
                    ->join('reserva_habitacions','reserva_habitacions.id','detalle_reserva_habitacions.reserva_habitacion_id')
                    ->join('cliente_hostals','cliente_hostals.id','detalle_reserva_habitacions.cliente_id')
                    ->join('habitacions','habitacions.id','reserva_habitacions.habitacion_id')
                    ->where('reserva_habitacions.ingreso_reserva','!=','0000-00-00 00:00:00')                                        
                    ->where('detalle_reserva_habitacions.cliente_id',$clienteHostal->id)
                    ->paginate(5);

        //return response()->json($hospedajes);
        return view('hostal.clientes.InformacionCliente', compact('clienteHostal', 'hospedajes','reservas'));
        
    }

    public function validarDocumento(Request $request){
        $documento = $request->documento;
        $cliente = ClienteHostal::where('Documento_cliente', $documento)->first();
        if ($cliente) {
            return 'existe';
        }
        return 'disponible';
    }

}
