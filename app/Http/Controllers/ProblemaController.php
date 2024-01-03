<?php

namespace App\Http\Controllers;

use App\Models\Problema;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\ProblemaRegistradoNotification;
use App\Notifications\ProblemaSolucionadoNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class ProblemaController extends Controller
{
   
    public function listproblem(){       
        $problemas = Problema::where('problemas.estado','=','INICIO')->orderBy('id', 'desc')->get();
        $problemasconcluidos = Problema::where('problemas.estado','=','CONCLUIDO')->orderBy('resuelto_fecha', 'desc')->get();
        $CantInicioProblemas = Problema::where('problemas.estado','=','INICIO')->count('id');
        $CantProgresoProblemas = Problema::where('problemas.estado','=','PROGRESO')->count('id');
        $CantSolucionadoProblemas = Problema::where('problemas.estado','=','CONCLUIDO')->count('id');
        //return response()->json($problemasconcluidos);
        return view('hostal.problemas.create',compact('problemasconcluidos','problemas','CantInicioProblemas','CantProgresoProblemas','CantSolucionadoProblemas'));
    }
    
    public function store(Request $request){
        $user = Auth::user(); 

        $datosproblema = Problema::create([
            'user_id' => Auth::user()->id,
            'titulo' => $request->titulo,
            'description' => $request->descripcion,
            'tipoproblema' => $request->tipoproblema,
            'estado' => 'INICIO',
            'asignado_fecha' => Carbon::now('America/La_Paz'),
        ]);

        $notificacion = new ProblemaRegistradoNotification($datosproblema);
        $users = User::all();
        Notification::send($users, $notificacion);

        // Devolver una respuesta JSON indicando que se ha creado el problema
        return response()->json([
            'success' => true,
            'message' => 'El problema ha sido creado correctamente'
        ]);        

    }

    public function update(Request $request, $id){
        $problemas = Problema::findOrFail($id);
        $problemas->solution = $request->input('descripcion');
        $problemas->resuelto_fecha = Carbon::now('America/La_Paz');
        $problemas->estado = 'CONCLUIDO';
        $problemas->save();


        $notificacion = new ProblemaSolucionadoNotification($problemas);
        $users = User::all();
        Notification::send($users, $notificacion);

        return back();
    }

    
}
