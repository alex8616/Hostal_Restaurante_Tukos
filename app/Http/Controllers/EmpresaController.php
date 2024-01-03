<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $empresa = Empresa::where('id', 1)->firstOrFail();
        return view('admin.empresa.index', compact('empresa'));
        /* 
        $empresa = Empresa::select('*')
        ->where('id', '=', 3)->get();
        */
        //return view('admin.empresa.index');
        return response()->json($empresa);
    }

    public function update(Request $request, Empresa $empresa){
    try {
        DB::beginTransaction();
        $empre = $request->all();
        if ($logo = $request->file('Empresa_Logo')) {
            $rutaGuardarLogo = 'imagen/';
            $logoEmpresa = date('YmdHis') . "." . $logo->getClientOriginalExtension();
            $logo->move($rutaGuardarLogo, $logoEmpresa);
            $empre['Empresa_Logo'] = "$logoEmpresa";
        } else {
        unset($empre['Empresa_Logo']);
        }
        $empresa->update($empre);
        DB::commit();
    } catch (\Throwable $th) {
        DB::rollback();
        notify()->error('No Se Pudo Actualizar .. ') or notify()->error('No Se Pudo Actualizar', 'No Actualizado ERROR');
        return redirect()->route('admin.empresa.index');
    }
        notify()->success('Se Actualizo La Informacion correctamente') or notify()->success('Se Actualizo correctamente ⚡️', 'Se Actualizo correctamente ');
        return redirect()->route('admin.empresa.index');
        //return response()->json(Cliente::where('id', '=', $id)->update($datoscliente));
    }
}
