<?php

namespace App\Http\Controllers;

use App\Models\TipoCliente;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ClienteDetalle;
use App\Models\User;
use Carbon\Carbon;
use App\Notifications\PensionNotification;
use Illuminate\Support\Facades\Notification;
use DB;

class TipoClienteController extends Controller{
    
    public function index()
    {
        $now = Carbon::now()->format('d-m-Y');
        $tipoclientes = TipoCliente::orderBy('id', 'desc')->get();
        $clientes = Cliente::get();
        return view('admin.pensionado.index',compact('clientes','tipoclientes','now'));
    }

    public function createtipo(){
        $tipoclientes = TipoCliente::get();
        $clientes = Cliente::get();
        return view('admin.pensionado.createtipo',compact('clientes','tipoclientes'));
    }

    public function listpensionados(){
       
        $news = TipoCliente::whereRaw("Fecha_Final = DATE(now())")->get();
        //return response()->json($news);
        return view('admin.pensionado.listpensionados', compact('news'));
    }

    public function cambio_de_estado($id){
        $tipocliente = TipoCliente::findOrFail($id);
        $tipocliente->tipo = 'Normal';
        $tipocliente->estado = 'FALSE';
        $tipocliente->update();
        return redirect()->back()->with('Confirmado');
    }
}
