<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::orderBy('id', 'desc')->get();
        return view('admin.categoria.listar',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categoria.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = request()->validate([
                'Nombre_categoria' => 'required|regex:/^[A-Z,a-z, ,á,í,é,ó,ú,ñ]+$/|max:50|unique:categorias',
               ]);
    
            $datoscategoria = Categoria::create([
                'Nombre_categoria' => $data['Nombre_categoria'],
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar, Ya tienes un registro con ese Nombre') or notify()->error('No Se Pudo Registrar⚡️', 'Articulo NO Registrado');
            return redirect()->route('admin.categoria.index');
        }
            notify()->success('Se registró correctamente') or notify()->success('Se registró correctamente ⚡️', 'Articulo Registrado Correctamente');
            return redirect()->route('admin.categoria.index');
    }

    /*
    public function edit(Categoria $categorium){
        return view('admin.categoria.edit', compact('categorium'));
        //return response()->json($categorium);
        
    }
    */

    public function updatecategoria(Request $request, $id){
        try {
            DB::beginTransaction();
            $Datoscategoria = Categoria:: findOrFail($id); 
            $Datoscategoria->Nombre_categoria = $request->Nombre_categoria;
            $Datoscategoria->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Actualizar El Registro') or notify()->error('No Se Pudo Registrar⚡️', 'Articulo NO Actualizado');
            return redirect()->route('admin.categoria.index');
        }
            notify()->success('Se Actualizo La Informacion correctamente') or notify()->success('Se Actualizo La Informacion correctamente ⚡️', 'Articulo Actualizo Correctamente');
            return redirect()->route('admin.categoria.index');
    }

    public function destroy(Categoria $categorium){
        $item = $categorium->platos()->count();
        if ($item > 0) {
            notify()->error('La Categoria Noce Puede Borrar') or notify()->success('La Categoria Noce Puede Borrar ⚡️', 'La Categoria Noce Puede Borrar');
            return redirect()->route('admin.categoria.index');
        }
        $categorium->delete();
        notify()->success('La Categoria Se Borro Correctamente') or notify()->success('La Categoria Se Borro correctamente ⚡️', 'La Categoria Se Borro Correctamente Correctamente');
        return redirect()->route('admin.categoria.index');
    }
}
