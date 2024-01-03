<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Mesa;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    public function index()
    {
        $clientes = Cliente::all(); 
        //$ventasmes = DB::select('SELECT month(comandas.fecha_venta) as mes, sum(comandas.total) as totalmes from comandas  group by month(comandas.fecha_venta) order by month(comandas.fecha_venta) desc limit 12');

        $ventasmes = DB::select('SELECT month(comandas.fecha_venta) as mes, sum(comandas.total) as totalmes from comandas  group by month(comandas.fecha_venta) order by month(comandas.fecha_venta) desc limit 12');

        $ventasdia = DB::select('SELECT DATE_FORMAT(comandas.fecha_venta,"%d/%m/%Y") as dia, sum(comandas.total) as totaldia from comandas  group by comandas.fecha_venta order by day(comandas.fecha_venta) desc limit 15');
      
        $productosvendidos = DB::select('SELECT   
        sum(detalle_comandas.cantidad) as cantidad, platos.Nombre_plato as Nombre_plato , platos.id as id  from platos
        inner join detalle_comandas on platos.id=detalle_comandas.plato_id 
        inner join comandas on detalle_comandas.comanda_id=comandas.id where year(comandas.fecha_venta)=year(curdate()) 
        group by platos.Nombre_plato, platos.id order by sum(detalle_comandas.cantidad) desc limit 10');
  
        $mesas = Mesa::all(); 

        $mesasventasmes = DB::select('SELECT month(comanda_mesas.fecha_venta) as mes, sum(comanda_mesas.total) as totalmes from comanda_mesas  group by month(comanda_mesas.fecha_venta) order by month(comanda_mesas.fecha_venta) desc limit 12');

        $mesasventasdia = DB::select('SELECT DATE_FORMAT(comanda_mesas.fecha_venta,"%d/%m/%Y") as dia, sum(comanda_mesas.total) as totaldia from comanda_mesas  group by comanda_mesas.fecha_venta order by day(comanda_mesas.fecha_venta) desc limit 15');
      
        
        $productosvendidomesas = DB::select('SELECT   
        sum(detalle_comanda_mesas.cantidad) as cantidad, platos.Nombre_plato as Nombre_plato , platos.id as id  from platos
        inner join detalle_comanda_mesas on platos.id=detalle_comanda_mesas.plato_id 
        inner join comanda_mesas on detalle_comanda_mesas.comanda_mesa_id=comanda_mesas.id where year(comanda_mesas.fecha_venta)=year(curdate()) 
        group by platos.Nombre_plato, platos.id order by sum(detalle_comanda_mesas.cantidad) desc limit 10');
        return view('home.dashboard', compact('ventasmes', 'clientes', 'ventasdia', 'productosvendidos', 'productosvendidomesas', 'mesas', 'mesasventasmes', 'mesasventasdia'));
    }
}
