<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\LibroNovedade;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LibroNovedadeController extends Controller
{

    public function StoreNovedadProblema(Request $request){
        $controles = $request->input('controles');
        $controles_string = implode(',', $controles);

        $llaves = $request->input('llaves');
        $llaves_string = implode(',', $llaves);

        $date = Carbon::now('America/La_Paz');
        $novedades = LibroNovedade::create([
            'caja_id' => $request->caja_id,
            'user_id' => $request->user_id,
            'controles' => $controles_string,
            'llaves' => $llaves_string,
            'datadisplay' => $request->datadisplay,
            'tanque_1' => $request->tanque_1,
            'tanque_2' => $request->tanque_2,
            'tanque_3' => $request->tanque_3,
            'detalle' => $request->editor,
            'Fecha_registro' => $date,
        ]);
       
        notify()->success('Se Registro Correctamente') or notify()->success('Se Registro Correctamente', 'Se Registro Correctamente');
        return back();
    }

    public function index(Request $request){
        $users = User::get(); 
        $novedades = LibroNovedade::paginate(3);
    
        $resultadoscontroles = array();
        $resultadosllaves = array();
    
        foreach ($novedades as $novedad) {
            $controles = $novedad->controles;
            $controles_array = explode(',', $controles);
            
            for ($i = 1; $i <= 17; $i++) {
                if (in_array(strval($i), $controles_array)) {
                    $resultadoscontroles[$novedad->id][$i] = "SI";
                } else {
                    $resultadoscontroles[$novedad->id][$i] = "NO";
                }
            }
    
            $llaves = $novedad->llaves;
            $llaves_array = explode(',', $llaves);
            
            for ($i = 1; $i <= 17; $i++) {
                if (in_array(strval($i), $llaves_array)) {
                    $resultadosllaves[$novedad->id][$i] = "SI";
                } else {
                    $resultadosllaves[$novedad->id][$i] = "NO";
                }
            }
        }
        return view('admin.caja.ListaNovedades', compact('users','novedades', 'resultadoscontroles', 'resultadosllaves'));
    }
    
}
