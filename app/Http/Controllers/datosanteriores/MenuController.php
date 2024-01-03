<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comanda\StoreRequest;
use App\Models\Comanda;
use Illuminate\Http\Request;
use App\Models\DetalleMenu;
use App\Models\DetalleComanda;
use App\Models\Cliente;
use App\Models\Plato;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use Dompdf\options;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;

class MenuController extends Controller
{

    public function index()
    {
        $platos = Plato::get();
        $menus = Menu::orderBy('id', 'desc')->paginate(5);
        $detallemenus = DetalleMenu::orderBy('id', 'asc')->get();
        return view ('admin.menu.index', compact('menus','detallemenus','platos'));
    }

    public function create()
    {
        $platos = Plato::get();
        $comanda = Comanda::get();
        return view('admin.menu.create', compact('comanda','platos'));
    }

	public function store(Request $request){
        $menuhoy = Menu::where('fecha_registro','=',Carbon::now()->format('Y-m-d'))
                        ->count();
        if($menuhoy == 0){
            try {
                DB::beginTransaction();
                $json = $request->all();
                $json['id_plato_nuevo'][] = '230';
                $json['id_plato_nuevo'][] = '141';
                $json['id_plato_nuevo'][] = '143';
                $json['id_plato_nuevo'][] = '145';
                
                $user = Auth::user();
                $menu = Menu::create($request->all() + [
                    'user_id' => Auth::user()->id,
                    'fecha_registro' => Carbon::now('America/La_Paz'),
                ]);
    
                $results = array();
                foreach($json['id_plato'] as $plato_id){
                    $results[] = array("plato_id" => $plato_id);
                }
                foreach($json['id_plato_nuevo'] as $plato_id_nuevo){
                    $results[] = array("plato_id" => $plato_id_nuevo);
                }
                
                $menu->detallemenus()->createMany($results);
                
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                notify()->error('No Se Pudo Registrar') or notify()->error('No Se Pudo Registrar⚡️', 'No Se Pudo Registrar');
                return redirect()->route('admin.menu.index');
            }
            notify()->success('Se registró correctamente') or notify()->success('Menu Registrado correctamente ⚡️', 'Menu Registrado Correctamente');
            return redirect()->route('admin.menu.index');
        }else{
            notify()->error('No se pudo registrar el menu por que ya se registro anteriormente.') or notify()->error('No Se Pudo Registrar⚡️', 'No Se Pudo Registrar');
            return redirect()->route('admin.menu.index');
        }
    }

    public function show(Menu $menu)
    {
        $detallemenus = $menu->detallemenus;
        return view('admin.menu.show', compact('menu', 'detallemenus'));
    }

    public function destroy(Menu $menu)
    {
        $item = $menu->detallemenus()->count();
        if ($item > 0) {
            notify()->error('El Menu Noce Puede Borrar') or notify()->success('El Menu Noce Puede Borrar⚡️', 'El Menu Noce Puede Borrar');
            return redirect()->route('admin.menu.index');
        }
        $menu->delete();
        notify()->success('El Menu Se Borro Correctamente') or notify()->success('El Menu Se Borro Correctamente ⚡️', 'El Menu Se Borro Correctamente');
        return redirect()->route('admin.menu.index');
    }
    
    public function pdf(Menu $menu){

        $detallemenus = $menu->detallemenus;
        //$pdf = PDF::loadView('menu.pdf', compact('menu', 'platos', 'detallemenus'))->setOptions(['defaultFont' => 'sans-serif'])->setOptions(['isRemoteEnabled',TRUE]);
        
        $pdf = PDF::loadView('admin.menu.pdf', compact('menu', 'detallemenus'))
        ->setPaper('a4')
                  ->setOptions([
                      'tempDir' => public_path(),
                      'chroot'  => public_path(),
                  ]);
        
        return $pdf->stream('Reporte_de_venta.pdf');
    }

    public function menuautocomplete(Request $request){
        $data = Plato::select("Nombre_plato as value", "Precio_plato","id","Nombre_plato")
                    ->where('Nombre_plato', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }

    public function addplus(Request $request){
        $idmenu = $request->id_menu;
        
        foreach($request->id_plato as $key=>$insert){
            $detallemenu = DetalleMenu::create([
                'menu_id' => $idmenu,
                'plato_id' =>  $request->id_plato[$key],
            ]);
        }
        notify()->success('Se registró correctamente') or notify()->success('Menu añadido correctamente ⚡️', 'Menu Registrado Correctamente');
        return redirect()->back()->with('Confirmado');
    }

}
