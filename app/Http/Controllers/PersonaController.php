<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PersonaController extends Controller
{
    public function index()
    {
        return view('admin.personal.index');
    }

    public function data(){
        $personalDate = Persona::get();
        return datatables()->of($personalDate)->toJson(); 
    }

    public function store(Request $request){
        $personal = Persona::create([
            'Nombre_Completo' => $request->Nombre_Completo,
            'Dni' => $request->Dni,
            'Cargo' => $request->Cargo,
        ]);
        return response()->json($personal);
    }

    public function edit(Request $request, $id){
        $personal = Persona::findOrFail($id);
        return response()->json($personal);
    } 
    
    public function updatepersonal(Request $request, $id){
        $personaupdate = Persona::findOrFail($id);
        $personaupdate->Nombre_Completo = $request->Edit_Nombre_Completo;
        $personaupdate->Dni = $request->Edit_Dni;
        $personaupdate->Cargo = $request->Edit_Cargo;
        $personaupdate->save();
        return response()->json($request);
    }

    public function AsistenciaHoja(Request $request){
        setlocale(LC_TIME, 'es_ES');
        $personals = Persona::get();
        $Month = $request->get('AsistenciaMes');
        list($year, $month) = explode('-', $Month);
        $monthText = strftime('%B', mktime(0, 0, 0, $month, 1, $year));
        $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $days = array();
        for ($day = 1; $day <= $numDays; $day++) {
            $date = sprintf('%04d-%02d-%02d', $year, $month, $day);
            $dayOfWeek = strftime('%A', strtotime($date));
            $days[] = array(
                'date' => $date,
                'dayOfWeek' => ucfirst(strftime('%A', strtotime($date)))
            );
        }
        $pdf = PDF::loadView('admin.personal.HojaAsistencia', compact('days','personals','monthText','year'))
                ->setPaper('A4', 'portrait');
        return $pdf->stream('Planilla'.time().'pdf');
    }

    public function eliminar($id){
        $personal = Persona::find($id);
        if($personal) {
            $personal->delete();
            return response()->json(['success' => true, 'message' => 'Registro eliminado exitosamente.']);
        } else {
            return response()->json(['success' => false, 'message' => 'No se ha podido eliminar el registro.']);
        }
    }

}
