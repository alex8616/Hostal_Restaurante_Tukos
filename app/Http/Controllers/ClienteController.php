<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\TipoCliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Database;
use Carbon\Carbon;
use App\Notifications\ClienteNotification;
use Illuminate\Support\Facades\Notification; 



class ClienteController extends Controller
{

    public function index(){
        $clientes = Cliente::orderBy('id', 'desc')->get();
        //auth()->user()->notify(new ClienteNotification($clientes));
        return view('admin.cliente.listar',compact('clientes'));
    }

    public function create(){
        //return view('admin.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request){
        try {
            DB::beginTransaction();
            $datoscliente = Cliente::create([
                'Nombre_cliente' => $request->Nombre_cliente,
                'Apellidop_cliente' => $request->Apellidop_cliente,
                'Nit_cliente' => $request->Nit_cliente,
                'Celular_cliente' => $request->Celular_cliente,
                'FechaNacimiento_cliente' => $request->Correo_cliente,
                'Correo_cliente' => $request->FechaNacimiento_cliente,
                'Ubicacion_cliente' => $request->ubicacion,
                'latidud' => $request->latitude,
                'longitud' => $request->longitude,
                'Direccion_cliente' => $request->address,
                'Zona_cliente' => $request->neighbourhood,
                'NDireccion_cliente' => $request->NDireccion_cliente,
            ]);

            DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar⚡️', 'Cliente NO Registrado');
                return redirect()->route('admin.cliente.index');
            }
                notify()->success('Se registró correctamente') or notify()->success('Se registró correctamente ⚡️', 'Registrado Correctamente');
                return redirect()->route('admin.cliente.index');
        }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $tipoclientes = Cliente::select('*')
        ->join('detalle_clientes', 'clientes.id', '=', 'detalle_clientes.cliente_id')
        ->join('tipo_clientes', 'tipo_clientes.id', '=', 'detalle_clientes.tipo_cliente_id')
        ->where('detalle_clientes.cliente_id', '=', $cliente->id)->get();
        $total_ventas = 0;
        foreach ($cliente->comandas as $key =>  $comanda) {
            $total_ventas +=$comanda->total;
        }
        return view('admin.cliente.show', compact('cliente', 'total_ventas','tipoclientes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //return response()->json($cliente);
        return view('admin.cliente.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function updatecliente(Request $request, $id){
    try {
        DB::beginTransaction();
        $datoscliente = request()->except(['_token', '_method']);
        Cliente::where('id', '=', $id)->update($datoscliente);
        $cliente = Cliente::findOrFail($id);
        DB::commit();
    } catch (\Throwable $th) {
        DB::rollback();
        notify()->error('No Se Pudo Actualizar .. ') or notify()->error('No Se Pudo Registrar⚡️', 'Cliente NO Registrado');
        return redirect()->route('admin.cliente.index');
    }
        notify()->success('Se Actualizo La Informacion correctamente') or notify()->success('Se registró correctamente ⚡️', 'Articulo Registrado Correctamente');
        return redirect()->route('admin.cliente.index');
        //return response()->json(Cliente::where('id', '=', $id)->update($datoscliente));
    }
        //return response()->json($request);

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente){
        $item = $cliente->comandas()->count();
        if ($item > 0) {
            notify()->error('El Cliente Noce Puede Borrar') or notify()->success('El Cliente Noce Puede Borrar', 'El Cliente Noce Puede Borrar');
            return redirect()->route('admin.cliente.index');
        }
        $cliente->delete();
        notify()->success('El Cliente Se Borro Correctamente') or notify()->success('El Cliente Se Borro Correctamente', 'El Cliente Se Borro Correctamente');
        return redirect()->route('admin.cliente.index');
    }

    public function listcumple(){
        $users = User::all();
        $news = Cliente::whereRaw("TIMESTAMPDIFF(YEAR, FechaNacimiento_cliente, CURDATE()) < TIMESTAMPDIFF(YEAR, FechaNacimiento_cliente, ADDDATE(CURDATE(), 7))")
                        ->get();
        return view('admin.cliente.listcumple', compact('news'));
    }

}
