<?php

namespace App\Http\Controllers;

use App\Models\Plato;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; 

class PlatoController extends Controller
{

    public function index(Request $request){
        $categorias = Categoria::get();
        //$platos = Plato::orderBy('id', 'desc')->get();
        
        $platos = Categoria::select('*')
        ->join('platos', 'platos.categoria_id', '=', 'categorias.id')
        ->orderBy('platos.id', 'desc')
        ->where('categorias.id','=',3)
        ->paginate(10);
        return view('admin.plato.index',compact('platos','categorias'));
    }

    public function cat($categoriasid)
    {
        $categorias = Categoria::get();
        $platos = Categoria::select('*')
        ->join('platos', 'platos.categoria_id', '=', 'categorias.id')
        ->orderBy('platos.id', 'desc')
        ->where('categorias.id','=',$categoriasid)
        ->paginate(5);
        //return response()->json($platos);
        return view('admin.plato.index',compact('platos','categorias'));
    }

    public function listar(Request $request)
    {
        $categorias = Categoria::get();
        $buscarpor=$request->get('buscarpor');
        $platos=Plato::where('Nombre_plato','like','%'.$buscarpor.'%')->orderBy('id', 'desc')->paginate(6);
        return view('admin.plato.listar',compact('platos','categorias','buscarpor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categorias = Categoria::get();
        return view('admin.plato.create',compact('categorias'));
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();
            $data = request()->validate([
                'Nombre_plato' => 'required',
                'Precio_plato' => 'required',
                'Caracteristicas_plato' => 'required',
                'categoria_id' => 'required',
            ]);
            
            $datosPlato = request()->except('_token');
            if ($request->hasFile('imagen')) {
                $datosPlato['imagen'] = $request->file('imagen')->store('uploads', 'public');
            }
            $plato = Plato::create($datosPlato);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar⚡️', 'Plato NO Registrado');
            return redirect()->route('admin.cliente.index');
        }
            notify()->success('Se Registro El Plato correctamente') or notify()->success('Se registró correctamente ⚡️', 'Plato Registrado Correctamente');
            return redirect()->route('admin.plato.index');
    }

    public function show(Plato $plato){
        return view('admin.plato.show',compact('plato'));
    }

    public function edit(Plato $plato){    
        $categorias = Categoria::get();
        return view('admin.plato.edit',compact('plato','categorias'));
    }

    public function updateplato(Request $request, $id){
        try {
            DB::beginTransaction();
            $datosplato = request()->except(['_token', '_method']);
            if ($request->hasFile('imagen')) {
                $plato = Plato::findOrFail($id);
                Storage::delete('public/' . $plato->imagen);
                $datosplato['imagen'] = $request->file('imagen')->store('uploads', 'public');
            }
            Plato::where('id', '=', $id)->update($datosplato);
            $plato = Plato::findOrFail($id);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            notify()->error('No Se Pudo Actualizar') or notify()->error('No Se Pudo Actualizar', 'Plato NO Actualizado');
            return redirect()->route('admin.cliente.index');
        }
            notify()->success('Se Actualizo El Plato correctamente') or notify()->success('Se Actualizo correctamente ⚡️', 'Plato Se Actualizo Correctamente');
            return redirect()->route('admin.plato.index');
    }
    
    public function destroy(Plato $plato){
        $item = $plato->detallecomandas()->count();
        if ($item > 0) {
            $smserror = 'La Plato Noce Puede Borrar';
            notify()->error($smserror) or notify()->success($smserror, $smserror);
            return redirect()->route('admin.plato.index');
        } 
        $plato->delete();
        $smssuccess ='El Plato Se Borro Correctamente correctamente';
        notify()->success($smssuccess) or notify()->success($smssuccess, $smssuccess);
        return redirect()->route('admin.plato.index');
    }
}
