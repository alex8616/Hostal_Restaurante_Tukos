<?php

namespace App\Http\Controllers;

use App\Models\DetalleClientes;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TipoCliente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetalleClientesController extends Controller{

    public function store(Request $request){
    try {
        DB::beginTransaction();
        $user = Auth::user();
        $tipocliente = TipoCliente::create($request->all() + [
            'user_id' => Auth::user()->id,
            'Nombre_tipoclientes' => 'Nombre_tipoclientes',
            'Direccion_tipoclientes' => 'Direccion_tipoclientes',
            'Fecha_Inicio' => 'Fecha_Inicio',
            'Fecha_Final' => 'Fecha_Final',
            'tipo' => 'tipo',
        ]);
        
        foreach($request->cliente_id as $key=>$insert){
            $results[] = array("cliente_id" => $request->cliente_id[$key]);
        }

        $tipocliente->detalleclientes()->createMany($results);
        DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar⚡️', 'No Se Pudo Registrar');
            return redirect()->route('admin.pensionado.index');
        }
            notify()->success('Se registró correctamente') or notify()->success('Se Registrado correctamente ⚡️', 'Se Registrado Correctamente');
            return redirect()->route('admin.pensionado.index');
        }

}
