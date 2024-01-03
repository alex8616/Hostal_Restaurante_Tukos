<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Menu;
use App\Models\DetalleMenu;
use App\Models\ComandaMesa;
use App\Models\DetalleComandaMesa;
use App\Models\Plato;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\TipoCliente;
use App\Models\Caja;
use App\Models\DetalleCaja;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mesas = Mesa::orderBy('id', 'desc')->get();
        return view('admin.mesa.index',compact('mesas'));
    }

    public function register(){
        return view('admin.mesa.register');
    }

    public function crear(Request $request){
    try {
        DB::beginTransaction();
        $data = request()->validate([
            'Nombre_mesa' => 'nullable|unique:mesas',
           ]);

        $datomesas = Mesa::create([
            'Nombre_mesa' => $data['Nombre_mesa'],
        ]);
        DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar, Ya tienes un registro con ese Nombre') or notify()->error('No Se Pudo Registrar⚡️', 'Mesa NO Registrado');
            return redirect()->route('admin.mesa.index');
        }
            notify()->success('Se registró correctamente') or notify()->success('Se registró correctamente ⚡️', 'Mesa Registrado Correctamente');
            return redirect()->route('admin.mesa.index');
    }
    
    public function create(){
        $ultimo_registro = Caja::latest('id')->first();
        $mesas = Mesa::get();
        $platos = Plato::get();
        $pensionados = TipoCliente::get();
        $comandamesa = ComandaMesa::distinct('id')->get();
        $menus = Menu::select('*')
        ->join('detalle_menus', 'menus.id', '=', 'detalle_menus.menu_id')
        ->join('platos', 'platos.id', '=', 'detalle_menus.plato_id')
        ->where('Fecha_registro', '=', Carbon::now()->toDateString())->get();
        //return response()->json($pensionados);
        return view('admin.mesa.create',compact('ultimo_registro','pensionados','menus','mesas', 'platos', 'comandamesa'));
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            $user = Auth::user();
            if($request->pensionado == 0){
                $comandamesa = ComandaMesa::create($request->all() + [
                    'pensionado_id' => $request->pensionado_id,
                    'user_id' => Auth::user()->id,
                    'fecha_venta' => Carbon::now('America/La_Paz'),
                ]);
            }else{
                $comandamesa = ComandaMesa::create($request->all() + [
                    'pensionado_id' => Null,
                    'user_id' => Auth::user()->id,
                    'fecha_venta' => Carbon::now('America/La_Paz'),
                ]);

                /*TODO ESTO PARA CREAR EN CAJAS DONDE CORRESPONDA ESTE CASO RESTAURANTE PEDIDOS*/
                $mesas = Mesa::findOrFail($request->mesa_id);         

                $DetalleCajas = DetalleCaja::create([
                    'caja_id' => $request->caja_id,
                    'codigo_caja_id' => 1,
                    'articulo_caja_id' => 24,
                    'Articulo_description' => 'Almuerzo '.$mesas->Nombre_mesa,
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
            }
            foreach($request->id_plato as $key=>$insert){
                $results[] = array("plato_id" => $request->id_plato[$key],
                                    "cantidad" => $request->cantidad[$key],
                                    "precio_venta" => $request->Precio_plato[$key],
                                    "comentario" => $request->comentario[$key]);
            }
            $comandamesa->detallecomandamesas()->createMany($results);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar COMANDA Mesa', 'No Se Pudo Registrar COMANDA Mesa');
            return redirect()->route('admin.comandamesa.index');
        }
        notify()->success('Se registró correctamente') or notify()->success('Se registró correctamente ⚡️', 'Mesa Registrado Correctamente');
        return redirect()->route('admin.comandamesa.index');
        //return response()->json($request);
    }

    public function show(Mesa $mesa){
        
        return view('admin.mesa.show', compact('mesa'));
    }

    public function edit(Mesa $mesa){
        return view('admin.mesa.edit', compact('mesa'));
    }

    public function updatemesa(Request $request, $id){
    try {
        DB::beginTransaction();
        $Datosmesa = Mesa:: findOrFail($id); 
        $Datosmesa->Nombre_mesa = $request->Nombre_mesa;
        $Datosmesa->save();
        DB::commit();
    } catch (\Throwable $th) {
        DB::rollback();
        notify()->error('No Se Pudo Actualizar El Registro') or notify()->error('No Se Pudo Registrar⚡️', 'Articulo NO Actualizado');
        return redirect()->route('admin.mesa.index');
    }
        notify()->success('Se Actualizo La Informacion correctamente') or notify()->success('Se Actualizo La Informacion correctamente ⚡️', 'Articulo Actualizo Correctamente');
        return redirect()->route('admin.mesa.index');
    }

    public function destroy(Mesa $mesa){
        $item = $mesa->comandamesas()->count();
        if ($item > 0) {
            notify()->error('La Mesa Noce Puede Borrar') or notify()->success('La Mesa Noce Puede Borrar ⚡️', 'La Mesa Noce Puede Borrar');
            return redirect()->back();
        }
        $mesa->delete();
        notify()->success('La Mesa Se Borro Correctamente') or notify()->success('La Mesa Se Borro correctamente ⚡️', 'La Mesa Se Borro Correctamente Correctamente');
        return redirect()->route('admin.mesa.index')->with('delete', 'ok');
    }
}
