<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PlatoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComandaController;
use App\Http\Controllers\ComandaMesaController;
use App\Http\Livewire\ReportesController;
use App\Http\Livewire\ReporteFacturaController;
use App\Http\Controllers\ReportFacturaController;
use App\Http\Livewire\ReporteMesaController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportMesaController;
use App\Http\Controllers\TipoClienteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\AmbienteController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\DetalleClientesController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\InventarioController;
use App\Http\Livewire\Articulos;
use App\Models\Ambiente;
//hostal xdd
use App\Http\Controllers\CategoriaHabitacionController;
use App\Http\Controllers\ClienteHostalController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\PisoHabitacionController;
use App\Http\Controllers\ProductoHostalController;
use App\Http\Controllers\ReporteHostalController;
use App\Models\ClienteHostal;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\BarController;
use App\Http\Controllers\ControlCamareriaController;
use App\Http\Controllers\FestivaleController;
use App\Http\Controllers\LibroNovedadeController;
use App\Http\Controllers\ProblemaController;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\QRMenuControlador;

Route::get('/', function () {
    return view('auth.login');
});
Route::resource('users', UserController::class)->names('admin.users')->middleware('auth');
Route::resource('roles', RoleController::class)->names('admin.roles')->middleware('auth');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/home-dashboard', [HomeController::class, 'index'])->middleware('auth')->name('home-dashboard');
Route::get('report/pdf/{user}/{type}/{f1}/{f2}', [ReportController::class, 'reportePDF'])->name('reporte.pdf')->middleware('auth');
Route::get('report/pdf/{user}/{type}', [ReportController::class, 'reportePDF'])->name('reporte.pdf')->middleware('auth');
Route::get('report/pdffactura/{user}/{type}/{estadofactura}/{f1}/{f2}', [ReportFacturaController::class, 'reporteEXCEL'])->name('reporte.excel')->middleware('auth');
Route::get('report/pdffactura/{user}/{estadofactura}/{type}', [ReportFacturaController::class, 'reporteEXCEL'])->name('reporte.excel')->middleware('auth');
Route::get('report/factura_pdf/{user}/{type}/{estadofactura}/{f1}/{f2}', [ReportFacturaController::class, 'reportePDF'])->name('reporte.pdf')->middleware('auth');
Route::get('report/factura_pdf/{user}/{estadofactura}/{type}', [ReportFacturaController::class, 'reportePDF'])->name('reporte.pdf')->middleware('auth');
Route::get('report/pdfmesa/{user}/{type}/{f1}/{f2}', [ReportMesaController::class, 'reportePDF'])->name('reporte.pdfmesa')->middleware('auth');
Route::get('report/pdfmesa/{user}/{type}', [ReportMesaController::class, 'reportePDF'])->name('reporte.pdfmesa')->middleware('auth');
Route::resource('menu', MenuController::class)->names('admin.menu')->middleware('auth');
Route::post('/menu/guardar',[MenuController::class,'guardar'])->middleware('auth');
Route::post('/menu/creater',[MenuController::class,'creater'])->middleware('auth');
Route::get('/menu/listar',[MenuController::class,'show'])->middleware('auth');
Route::get('menu/pdf/{menu}', [MenuController::class, 'pdf'])->name('admin.menu.pdf')->middleware('auth');
Route::post('menu.addplus', [MenuController::class, 'addplus'])->name('admin.menu.addplus')->middleware('auth');
Route::get('calendar', [EventController::class, 'index'])->name('calendar.index')->middleware('auth');;
Route::post('calendar/create-event', [EventController::class, 'create'])->name('calendar.create')->middleware('auth');
Route::patch('calendar/edit-event', [EventController::class, 'edit'])->name('calendar.edit')->middleware('auth');
Route::delete('calendar/remove-event', [EventController::class, 'destroy'])->name('calendar.destroy')->middleware('auth');
//Route::resource('evento', EventController::class)->names('admin.evento')->middleware('auth');
Route::resource('mesa', MesaController::class)->names('admin.mesa')->middleware('auth');
Route::resource('plato', PlatoController::class)->names('admin.plato')->middleware('auth');
Route::resource('cliente', ClienteController::class)->names('admin.cliente')->middleware('auth');
Route::resource('categoria', CategoriaController::class)->except('show')->names('admin.categoria')->middleware('auth');
Route::resource('comanda', ComandaController::class)->names('admin.comanda')->middleware('auth');
Route::resource('tipopensionado', DetalleClientesController::class)->names('admin.tipopensionado')->middleware('auth');
Route::resource('ambiente', AmbienteController::class)->names('admin.ambiente')->middleware('auth');
Route::get('ambiente/{ambiente}/reserva', [AmbienteController::class, 'reserva'])->name('admin.ambiente.reserva')->middleware('auth');
Route::post('ambiente.reservastore', [AmbienteController::class, 'reservastore'])->name('admin.ambiente.reservastore')->middleware('auth');
Route::put('updatereserva/{id}', [AmbienteController::class, 'updatereserva'])->name('updatereserva')->middleware('auth');
Route::delete('ambiente.destroyreserva/{reserva}', [AmbienteController::class, 'destroyreserva'])->name('ambiente.destroyreserva')->middleware('auth');
Route::resource('reserva', ReservaController::class)->names('admin.reserva')->middleware('auth');
Route::resource('empresa', EmpresaController::class)->names('admin.empresa')->middleware('auth');
Route::resource('caja', CajaController::class)->names('admin.caja')->middleware('auth');
Route::get('caja.codigo', [CajaController::class, 'codigo'])->name('admin.caja.codigo')->middleware('auth');
Route::get('caja.articulos', [CajaController::class, 'articulos'])->name('admin.caja.articulos')->middleware('auth');
Route::get('caja/{caja}/registrar', [CajaController::class, 'registrar'])->name('admin.caja.registrar')->middleware('auth');
Route::get('caja/{caja}/registrar_restaurante', [CajaController::class, 'registrar_restaurante'])->name('admin.caja.registrar_restaurante')->middleware('auth');
Route::get('caja/{caja}/registrar_tarjeta', [CajaController::class, 'registrar_tarjeta'])->name('admin.caja.registrar_tarjeta')->middleware('auth');
Route::get('caja/{caja}/registrar_deposito', [CajaController::class, 'registrar_deposito'])->name('admin.caja.registrar_deposito')->middleware('auth');
Route::get('caja/{caja}/reporte_mensual', [CajaController::class, 'reporte_mensual'])->name('admin.caja.reporte_mensual')->middleware('auth');
Route::get('caja/{caja}/reporte_mensual_unique', [CajaController::class, 'reporte_mensual_unique'])->name('admin.caja.reporte_mensual_unique')->middleware('auth');
Route::get('caja.reportesfull', [CajaController::class, 'reportesfull'])->name('admin.caja.reportesfull')->middleware('auth');
Route::get('caja.reportesfullexportar', [CajaController::class, 'reportesfullexportar'])->name('admin.caja.reportesfullexportar')->middleware('auth');
Route::get('caja.reportescajapersonalizado', [CajaController::class, 'reportescajapersonalizado'])->name('admin.caja.reportescajapersonalizado')->middleware('auth');
//Route::post('/register', 'AuthController@register')->name('register');    
//Route::get('detallecaja/data', [CajaController::class, 'data'])->name('detallecaja.data');
Route::get('detallecaja/data/{caja}', [CajaController::class, 'data'])->name('detallecaja.data')->middleware('auth');
Route::get('detallecaja/datarestaurante/{caja}', [CajaController::class, 'datarestaurante'])->name('detallecaja.datarestaurante')->middleware('auth');
Route::get('detallecaja/datatarjetas/{caja}', [CajaController::class, 'datatarjetas'])->name('detallecaja.datatarjetas')->middleware('auth');
Route::get('detallecaja/datadepositos/{caja}', [CajaController::class, 'datadepositos'])->name('detallecaja.datadepositos')->middleware('auth');
Route::get('detallecaja/edit/{id}', [CajaController::class, 'edit'])->name('detallecaja.edit')->middleware('auth');
Route::put('detallecaja/{id}', [CajaController::class, 'update'])->name('detallecaja.update')->middleware('auth');
Route::put('detallecajaRestaurante/{id}', [CajaController::class, 'updateRestaurante'])->name('detallecaja.updateRestaurante')->middleware('auth');
Route::put('detallecajaTarjetas/{id}', [CajaController::class, 'updateTarjetas'])->name('detallecaja.updateTarjetas')->middleware('auth');
Route::put('detallecajaDepositos/{id}', [CajaController::class, 'updateDepositos'])->name('detallecaja.updateDepositos')->middleware('auth');
Route::post('caja.storedetallecaja', [CajaController::class, 'storedetallecaja'])->name('admin.caja.storedetallecaja')->middleware('auth');
Route::post('caja.storedetallecajaRestaurante', [CajaController::class, 'storedetallecajaRestaurante'])->name('admin.caja.storedetallecajaRestaurante')->middleware('auth');
Route::post('caja.storedetallecajaTarjetas', [CajaController::class, 'storedetallecajaTarjetas'])->name('admin.caja.storedetallecajaTarjetas')->middleware('auth');
Route::post('caja.storedetallecajaDepositos', [CajaController::class, 'storedetallecajaDepositos'])->name('admin.caja.storedetallecajaDepositos')->middleware('auth');
Route::delete('caja.destroydetallecaja/{detallecaja}', [CajaController::class, 'destroydetallecaja'])->name('caja.destroydetallecaja')->middleware('auth');
Route::delete('caja.destroydetallecajaRestaurante/{detallecaja}', [CajaController::class, 'destroydetallecajaRestaurante'])->name('caja.destroydetallecajaRestaurante')->middleware('auth');
Route::delete('caja.destroydetallecajaTarjetas/{detallecaja}', [CajaController::class, 'destroydetallecajaTarjetas'])->name('caja.destroydetallecajaTarjetas')->middleware('auth');
Route::delete('caja.destroydetallecajaDepositos/{detallecaja}', [CajaController::class, 'destroydetallecajaDepositos'])->name('caja.destroydetallecajaDepositos')->middleware('auth');
Route::post('/actualizar_estado', [CajaController::class, 'actualizarEstado'])->name('detallecaja.actualizar_estado')->middleware('auth');
Route::post('/actualizarEstadoRestaurante', [CajaController::class, 'actualizarEstadoRestaurante'])->name('detallecaja.actualizarEstadoRestaurante')->middleware('auth');
Route::post('caja.storedetallecajacerrar', [CajaController::class, 'storedetallecajacerrar'])->name('admin.caja.storedetallecajacerrar')->middleware('auth');
Route::post('caja.storecodigo', [CajaController::class, 'storecodigo'])->name('admin.caja.storecodigo')->middleware('auth');
Route::delete('caja.destroycodigo/{codigoCaja}', [CajaController::class, 'destroycodigo'])->name('caja.destroycodigo')->middleware('auth');
Route::put('updatecodigo/{id}', [CajaController::class, 'updatecodigo'])->name('updatecodigo')->middleware('auth');
Route::post('caja.storearticulo', [CajaController::class, 'storearticulo'])->name('admin.caja.storearticulo')->middleware('auth');
Route::put('updatearticulo/{id}', [CajaController::class, 'updatearticulo'])->name('updatearticulo')->middleware('auth');
Route::delete('caja.destroyarticulo/{articuloCaja}', [CajaController::class, 'destroyarticulo'])->name('caja.destroyarticulo')->middleware('auth');
Route::get('caja.buscador', [CajaController::class, 'buscador'])->name('admin.caja.buscador')->middleware('auth');
Route::get('caja/{caja}/buscarhostal', [CajaController::class, 'buscarhostal'])->name('admin.caja.buscarhostal')->middleware('auth');
Route::get('caja/{caja}/buscartarjeta', [CajaController::class, 'buscartarjeta'])->name('admin.caja.buscartarjeta')->middleware('auth');
Route::get('caja/{caja}/buscardeposito', [CajaController::class, 'buscardeposito'])->name('admin.caja.buscardeposito')->middleware('auth');
Route::get('caja/{caja}/buscarrestaurante', [CajaController::class, 'buscarrestaurante'])->name('admin.caja.buscarrestaurante')->middleware('auth');
Route::get('caja/{caja}/Cajapdf', [CajaController::class, 'Cajapdf'])->name('admin.caja.Cajapdf')->middleware('auth');
Route::get('caja/{caja}/reporte_mes_especifico', [CajaController::class, 'reporte_mes_especifico'])->name('admin.caja.reporte_mes_especifico')->middleware('auth');
Route::delete('caja.destroycaja/{caja}', [CajaController::class, 'destroycaja'])->name('caja.destroycaja')->middleware('auth');
Route::get('caja/{caja}/Cajaexcel', [CajaController::class, 'Cajaexcel'])->name('admin.caja.Cajaexcel')->middleware('auth');
Route::put('updatedetallecaja/{id}', [CajaController::class, 'updatedetallecaja'])->name('updatedetallecaja')->middleware('auth');
Route::put('updatedolar/{id}', [CajaController::class, 'updatedolar'])->name('updatedolar')->middleware('auth');
Route::get('comanda/{factura}/excelfacturas', [ComandaController::class, 'excelfacturas'])->name('admin.comanda.excelfacturas')->middleware('auth');
Route::post('mesa.crear', [MesaController::class, 'crear'])->name('admin.mesa.crear')->middleware('auth');
Route::get('caja.reporte_general_mensual', [CajaController::class, 'reporte_general_mensual'])->name('admin.caja.reporte_general_mensual')->middleware('auth');
Route::get('caja.estadoResultado', [CajaController::class, 'estadoResultado'])->name('admin.caja.estadoResultado')->middleware('auth');

/*
esto son para inventario cocina 
*/
Route::get('cambio_de_estado/articulos/{articulo}', [Articulos::class, 'cambio_de_estado'])->name('cambio.estado.articulo')->middleware('auth');
Route::get('mesa.register', [MesaController::class, 'register'])->name('admin.mesa.register')->middleware('auth');
Route::get('inventario_cocina.index', [InventarioController::class, 'index'])->name('admin.inventario_cocina.index')->middleware('auth');
Route::post('inventario_cocina.store', [InventarioController::class, 'store'])->name('admin.inventario_cocina.store')->middleware('auth');
Route::delete('inventario_cocina.destroyinventarioarticulo/{articulo}', [InventarioController::class, 'destroyinventarioarticulo'])->name('inventario_cocina.destroyinventarioarticulo')->middleware('auth');
Route::get('cambio_de_estado/inventario_cocina/{articulo}', [InventarioController::class, 'cambio_de_estado'])->name('cambio.estado.inventario_cocina')->middleware('auth');
Route::get('inventario_cocina.Articulosexcel', [InventarioController::class, 'Articulosexcel'])->name('inventario_cocina.Articulosexcel')->middleware('auth');
Route::get('inventario_cocina.Articulospdf', [InventarioController::class, 'Articulospdf'])->name('inventario_cocina.articuloxportPDF')->middleware('auth');
Route::get('inventario_cocina/data', [InventarioController::class, 'data'])->name('inventario_cocina.data')->middleware('auth');
Route::get('articulos/edit/{id}', [InventarioController::class, 'edit'])->name('articulos.edit')->middleware('auth');
Route::put('updateinventarioarticulo/{id}', [InventarioController::class, 'updateinventarioarticulo'])->name('updateinventarioarticulo')->middleware('auth');
Route::put('updateinventarioarticulototal/{id}', [InventarioController::class, 'updateinventarioarticulototal'])->name('updateinventarioarticulototal')->middleware('auth');
//Route::put('detallecajaDepositos/{id}', [CajaController::class, 'updateDepositos'])->name('detallecaja.updateDepositos');
/*
hasta aqui
*/
Route::get('comanda.createtukomana', [ComandaController::class, 'createtukomana'])->name('admin.comanda.createtukomana')->middleware('auth');
Route::get('comanda.createcafeteria', [ComandaController::class, 'createcafeteria'])->name('admin.comanda.createcafeteria')->middleware('auth');
Route::get('comanda.createpensionado', [ComandaController::class, 'createpensionado'])->name('admin.comanda.createpensionado')->middleware('auth');
Route::post('comanda.storepensionado', [ComandaController::class, 'storepensionado'])->name('admin.comanda.storepensionado')->middleware('auth');
Route::post('comanda.storetukomana', [ComandaController::class, 'storetukomana'])->name('admin.comanda.storetukomana')->middleware('auth');
Route::post('comanda.storecafeteria', [ComandaController::class, 'storecafeteria'])->name('admin.comanda.storecafeteria')->middleware('auth');
Route::resource('comandamesa', ComandaMesaController::class)->names('admin.comandamesa')->middleware('auth');
Route::get('cambio_de_estado/comandas/{comanda}', [ComandaController::class, 'cambio_de_estado'])->name('cambio.estado.comanda')->middleware('auth');
Route::get('cambio_estado_factura/comandas/{factura}', [ComandaController::class, 'cambio_estado_factura'])->name('cambio.estado.factura')->middleware('auth');
Route::get('comandamesa/pdf/{comandaMesa}', [ComandaMesaController::class, 'pdf'])->name('admin.comandamesa.pdf')->middleware('auth');
Route::get('comandamesa.ReporteMesasDiario', [ComandaMesaController::class, 'ReporteMesasDiario'])->name('admin.comandamesa.ReporteMesasDiario')->middleware('auth');
Route::get('comandamesa.ReporteMesasMes', [ComandaMesaController::class, 'ReporteMesasMes'])->name('admin.comandamesa.ReporteMesasMes')->middleware('auth');
Route::get('comanda.ReporteMesasRangeFecha', [ComandaMesaController::class, 'ReporteMesasRangeFecha'])->name('admin.comandamesa.ReporteMesasRangeFecha')->middleware('auth');
Route::get('comanda/pdf/{comanda}', [ComandaController::class, 'pdf'])->name('admin.comanda.pdf')->middleware('auth');
Route::get('comanda/factura/{factura}', [ComandaController::class, 'factura'])->name('admin.comanda.factura')->middleware('auth');
Route::get('comanda/ticketfactura/{factura}', [ComandaController::class, 'ticketfactura'])->name('admin.comanda.ticketfactura')->middleware('auth');
Route::get('comanda.facturas', [ComandaController::class, 'facturas'])->name('admin.comanda.facturas')->middleware('auth');
Route::get('comanda.reporteFull', [ComandaController::class, 'reporteFull'])->name('comanda.reporteFull')->middleware('auth');
Route::get('comanda.TukoRangeFecha', [ComandaController::class, 'TukoRangeFecha'])->name('admin.comanda.TukoRangeFecha')->middleware('auth');
Route::get('comanda.ReporteTukomanasPDF', [ComandaController::class, 'ReporteTukomanasPDF'])->name('comanda.ReporteTukomanasPDF')->middleware('auth');
Route::get('comanda.ReportePedidosMes', [ComandaController::class, 'ReportePedidosMes'])->name('admin.comanda.ReportePedidosMes')->middleware('auth');
Route::get('comanda.ReportePedidosDetalle', [ComandaController::class, 'ReportePedidosDetalle'])->name('admin.comanda.ReportePedidosDetalle')->middleware('auth');
Route::get('comanda.ReportePedidosDiario', [ComandaController::class, 'ReportePedidosDiario'])->name('admin.comanda.ReportePedidosDiario')->middleware('auth');
Route::get('comanda.ReportePedidosRangeFecha', [ComandaController::class, 'ReportePedidosRangeFecha'])->name('admin.comanda.ReportePedidosRangeFecha')->middleware('auth');
Route::get('comanda.ReporteTukomanasDiario', [ComandaController::class, 'ReporteTukomanasDiario'])->name('admin.comanda.ReporteTukomanasDiario')->middleware('auth');
Route::get('comanda.ReporteTukomanasMes', [ComandaController::class, 'ReporteTukomanasMes'])->name('admin.comanda.ReporteTukomanasMes')->middleware('auth');
Route::get('comanda.ReporteTukomanasRangeFecha', [ComandaController::class, 'ReporteTukomanasRangeFecha'])->name('admin.comanda.ReporteTukomanasRangeFecha')->middleware('auth');
Route::get('comanda.ReporteCafeteriaDiario', [ComandaController::class, 'ReporteCafeteriaDiario'])->name('admin.comanda.ReporteCafeteriaDiario')->middleware('auth');
Route::get('comanda.ReporteCafeteriaMes', [ComandaController::class, 'ReporteCafeteriaMes'])->name('admin.comanda.ReporteCafeteriaMes')->middleware('auth');
Route::get('comanda.ReporteCafeteriaRangeFecha', [ComandaController::class, 'ReporteCafeteriaRangeFecha'])->name('admin.comanda.ReporteCafeteriaRangeFecha')->middleware('auth');
Route::get('comanda.ReporteComidaRapidaDiario', [ComandaController::class, 'ReporteComidaRapidaDiario'])->name('admin.comanda.ReporteComidaRapidaDiario')->middleware('auth');
Route::get('comanda.ReporteComidaRapidaMes', [ComandaController::class, 'ReporteComidaRapidaMes'])->name('admin.comanda.ReporteComidaRapidaMes')->middleware('auth');
Route::get('comanda.ReporteComidaRapidaRangeFecha', [ComandaController::class, 'ReporteComidaRapidaRangeFecha'])->name('admin.comanda.ReporteComidaRapidaRangeFecha')->middleware('auth');
Route::get('comanda.ReportePlatosVendido', [ComandaController::class, 'ReportePlatosVendido'])->name('admin.comanda.ReportePlatosVendido')->middleware('auth');
Route::get('reports.component', ReportesController::class)->middleware('auth')->name('reports.reportes')->middleware('auth');
Route::get('reports.reporteFactura', ReporteFacturaController::class)->middleware('auth')->name('reports.reportefacturas')->middleware('auth');
Route::get('reports.ComponetMesa', ReporteMesaController::class)->middleware('auth')->name('reports.reportemesa')->middleware('auth');
Route::get('plato.listar', [PlatoController::class, 'listar'])->name('admin.plato.listar')->middleware('auth');
Route::get('plato.cat/{categorias}', [PlatoController::class, 'cat'])->name('admin.plato.cat')->middleware('auth');
Route::get('cliente.listvip', [ClienteController::class, 'listvip'])->name('admin.cliente.listvip')->middleware('auth');
Route::get('cliente.listcumple', [ClienteController::class, 'listcumple'])->name('admin.cliente.listcumple')->middleware('auth');
Route::get('pensionado.listpensionados', [TipoClienteController::class, 'listpensionados'])->name('admin.pensionado.listpensionados')->middleware('auth');
Route::get('pensionado.createtipo', [TipoClienteController::class, 'createtipo'])->name('admin.pensionado.createtipo')->middleware('auth');
Route::get('comanda.listapedidos', [ComandaController::class, 'listapedidos'])->name('admin.comanda.listapedidos')->middleware('auth');
Route::get('notifications/get',[ClienteController::class, 'getNotificationsData'])->name('notifications.get')->middleware('auth');
Route::resource('pensionado', TipoClienteController::class)->names('admin.pensionado')->middleware('auth');
Route::get('cambio_de_estado/pensionado/{tipocliente}', [TipoClienteController::class, 'cambio_de_estado'])->name('cambio.estado.tipocliente')->middleware('auth');
Route::put('updatecategoria/{id}', [CategoriaController::class, 'updatecategoria'])->name('updatecategoria')->middleware('auth');
Route::put('updatemenu/{id}', [MenuController::class, 'updatemenu'])->name('updatemenu')->middleware('auth');
Route::get('comanda.listacomidarapida', [ComandaController::class, 'listacomidarapida'])->name('admin.comanda.listacomidarapida')->middleware('auth');
Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');
Route::put('updatecliente/{id}', [ClienteController::class, 'updatecliente'])->name('updatecliente')->middleware('auth');
Route::put('selectfactura/{id}', [ComandaController::class, 'selectfactura'])->name('selectfactura')->middleware('auth');
Route::put('updateplato/{id}', [PlatoController::class, 'updateplato'])->name('updateplato')->middleware('auth');
Route::put('updatemesa/{id}', [MesaController::class, 'updatemesa'])->name('updatemesa')->middleware('auth');
Route::get('pruebauno',[ComandaController::class, 'dato'])->middleware('auth');;
Route::controller(ComandaController::class)->group(function(){
    Route::get('autocomplete', 'autocomplete')->name('autocomplete')->middleware('auth');
    Route::get('autocompletecliente', 'autocompletecliente')->name('autocompletecliente')->middleware('auth');
    Route::get('autocompletepensionado', 'autocompletepensionado')->name('autocompletepensionado')->middleware('auth');
});
Route::controller(CajaController::class)->group(function(){
    Route::get('autocompletearticulo', 'autocompletearticulo')->name('autocompletearticulo')->middleware('auth');
    Route::get('autocompletecodigo', 'autocompletecodigo')->name('autocompletecodigo')->middleware('auth');
});
Route::controller(MenuController::class)->group(function(){
    Route::get('menuautocomplete', 'menuautocomplete')->name('menuautocomplete')->middleware('auth');
});
Route::get('comanda.rangehour', [ComandaController::class, 'rangehour'])->name('admin.comanda.rangehour')->middleware('auth');
Route::get('comanda.reportehoras', [ComandaController::class, 'reportehoras'])->name('admin.comanda.reportehoras')->middleware('auth');
Route::get('ambiente/pdf/{reserva}', [AmbienteController::class, 'pdf'])->name('admin.ambiente.pdf')->middleware('auth');
Route::get('ambiente/{ambiente}/CrearReserva', [AmbienteController::class, 'CrearReserva'])->name('admin.ambiente.CrearReserva')->middleware('auth');
Route::get('ambiente/{ambiente}/ExportPDF', [AmbienteController::class, 'ExportPDF'])->name('admin.ambiente.ExportPDF')->middleware('auth');
Route::get('ambiente/{ambiente}/rangefecha', [AmbienteController::class, 'rangefecha'])->name('admin.ambiente.rangefecha')->middleware('auth');
Route::get('ambiente.reportegeneral', [AmbienteController::class, 'reportegeneral'])->name('admin.ambiente.reportegeneral')->middleware('auth');
Route::get('ambiente.reportegeneralfecha', [AmbienteController::class, 'reportegeneralfecha'])->name('admin.ambiente.reportegeneralfecha')->middleware('auth');
///hostal desde aqui xddd
Route::resource('categoriahabitacion', CategoriaHabitacionController::class)->names('hostal.categoriahabitacion')->middleware('auth');
Route::resource('pisohabitacion', PisoHabitacionController::class)->names('hostal.pisohabitacion')->middleware('auth');
Route::resource('habitacion', HabitacionController::class)->names('hostal.habitacion')->middleware('auth');
Route::resource('producto', ProductoHostalController::class)->names('hostal.producto')->middleware('auth');
Route::post('habitacion.hospedajestore', [HabitacionController::class, 'hospedajestore'])->name('hostal.habitacion.hospedajestore')->middleware('auth');
Route::get('habitacion/{habitacion}/CrearHospedaje', [HabitacionController::class, 'CrearHospedaje'])->name('hostal.habitacion.CrearHospedaje')->middleware('auth');
Route::controller(HabitacionController::class)->group(function(){
    Route::get('autocompletehostalcliente', 'autocompletehostalcliente')->name('autocompletehostalcliente')->middleware('auth');
    Route::get('autocompletehostalproducto', 'autocompletehostalproducto')->name('autocompletehostalproducto')->middleware('auth');
});
Route::get('habitacion/{habitacion}/DetalleHospedaje', [HabitacionController::class, 'DetalleHospedaje'])->name('hostal.habitacion.DetalleHospedaje')->middleware('auth');
Route::post('habitacion.ProductoStore', [HabitacionController::class, 'ProductoStore'])->name('hostal.habitacion.ProductoStore')->middleware('auth');
Route::post('habitacion.ServicioStore', [HabitacionController::class, 'ServicioStore'])->name('hostal.habitacion.ServicioStore')->middleware('auth');
Route::post('habitacion.ServicioDesayuno', [HabitacionController::class, 'ServicioDesayuno'])->name('hostal.habitacion.ServicioDesayuno')->middleware('auth');
Route::post('habitacion.ServicioLimpieza', [HabitacionController::class, 'ServicioLimpieza'])->name('hostal.habitacion.ServicioLimpieza')->middleware('auth');
Route::put('updatehabitacion/{id}', [HabitacionController::class, 'updatehabitacion'])->name('updatehabitacion')->middleware('auth');
Route::put('CambiarEstadoLimpieza/{id}', [HabitacionController::class, 'CambiarEstadoLimpieza'])->name('CambiarEstadoLimpieza')->middleware('auth');
Route::post('habitacion.reservastore', [HabitacionController::class, 'reservastore'])->name('hostal.habitacion.reservastore')->middleware('auth');
Route::get('habitacion/{habitacion}/CrearReserva', [HabitacionController::class, 'CrearReserva'])->name('hostal.habitacion.CrearReserva')->middleware('auth');
//Route::put('ConcluirReserva/{id}', [HabitacionController::class, 'ConcluirReserva'])->name('ConcluirReserva');
Route::get('habitacion/{habitacion}/DetalleReserva', [HabitacionController::class, 'DetalleReserva'])->name('hostal.habitacion.DetalleReserva')->middleware('auth');
Route::post('habitacion.ServicioDesayunoReserva', [HabitacionController::class, 'ServicioDesayunoReserva'])->name('hostal.habitacion.ServicioDesayunoReserva')->middleware('auth');
Route::get('habitacion.fullcalendar', [HabitacionController::class, 'fullcalendar'])->name('hostal.habitacion.fullcalendar')->middleware('auth');
Route::get('habitacion.ServiciosIncluidos', [HabitacionController::class, 'ServiciosIncluidos'])->name('hostal.habitacion.ServiciosIncluidos')->middleware('auth');
Route::post('habitacion.storeclienteinvitadoReserva', [HabitacionController::class, 'storeclienteinvitadoReserva'])->name('hostal.habitacion.storeclienteinvitadoReserva')->middleware('auth');
Route::post('habitacion.storeclienteinvitadoHospedaje', [HabitacionController::class, 'storeclienteinvitadoHospedaje'])->name('hostal.habitacion.storeclienteinvitadoHospedaje')->middleware('auth');
///
Route::get('habitacion/{reservahabitacion}/ConcluirReserva', [HabitacionController::class, 'ConcluirReserva'])->name('hostal.habitacion.ConcluirReserva')->middleware('auth');
Route::get('get_rooms_by_id', [HabitacionController::class, 'get_rooms_by_id'])->name('get_rooms_by_id')->middleware('auth');
Route::put('CancelarReserva/{reservahabitacion}', [HabitacionController::class, 'CancelarReserva'])->name('CancelarReserva')->middleware('auth');
Route::get('habitacion.ReservasLista', [HabitacionController::class, 'ReservasLista'])->name('hostal.habitacion.ReservasLista')->middleware('auth');
Route::get('habitacion/hospedajePDF/{hospedajehabitacion}', [HabitacionController::class, 'hospedajePDF'])->name('hostal.habitacion.hospedajePDF')->middleware('auth');
Route::get('habitacion/reservaPDF/{reservahabitacion}', [HabitacionController::class, 'reservaPDF'])->name('hostal.habitacion.reservaPDF')->middleware('auth');
Route::get('/api/reservations/check', [HabitacionController::class, 'checkAvailability'])->middleware('auth');
//ruta
//Route::post('/clientes/convertir-ubicacion', 'ClientController@convertirUbicacion');
Route::get('habitacion.pruebas', [HabitacionController::class, 'pruebas'])->name('hostal.habitacion.pruebas')->middleware('auth');
Route::post('habitacion.storepruebas', [HabitacionController::class, 'storepruebas'])->name('hostal.habitacion.storepruebas')->middleware('auth');
Route::post('habitacion.registrarcliente', [HabitacionController::class, 'registrarcliente'])->name('hostal.habitacion.registrarcliente')->middleware('auth');
//ruta
Route::get('habitacion.HospedajesLista', [HabitacionController::class, 'HospedajesLista'])->name('hostal.habitacion.HospedajesLista')->middleware('auth');        
Route::get('reportesHostal.index', [ReporteHostalController::class, 'index'])->name('hostal.reportesHostal.index')->middleware('auth');        
Route::get('habitacion.CamaraHotelera', [HabitacionController::class, 'CamaraHotelera'])->name('hostal.habitacion.CamaraHotelera')->middleware('auth');  
Route::get('habitacion.NovedadProblema', [HabitacionController::class, 'NovedadProblema'])->name('hostal.habitacion.NovedadProblema')->middleware('auth');  
Route::get('reportesHostal.ReporteRangeDate', [ReporteHostalController::class, 'ReporteRangeDate'])->name('hostal.reportesHostal.ReporteRangeDate')->middleware('auth');
Route::get('reportesHostal.ReporteMeses', [ReporteHostalController::class, 'ReporteMeses'])->name('hostal.reportesHostal.ReporteMeses')->middleware('auth');
Route::get('reportesHostal.ReporteSemanas', [ReporteHostalController::class, 'ReporteSemanas'])->name('hostal.reportesHostal.ReporteSemanas')->middleware('auth');
Route::get('/getDataByMonth/{month}', [ReporteHostalController::class, 'getDataByMonth'])->middleware('auth');
Route::get('/getDataByMonthRes/{month}', [ReporteHostalController::class, 'getDataByMonthRes'])->middleware('auth');
///rutas product
Route::get('/mathCaptchaImage', [ProductoHostalController::class, 'mathCaptchaImage'])->name('mathCaptchaImage')->middleware('auth');
Route::get('/getMathCaptchaImage', [ProductoHostalController::class, 'getMathCaptchaImage'])->name('getMathCaptchaImage')->middleware('auth');
Route::put('updatestock/{id}', [ProductoHostalController::class, 'updatestock'])->name('updatestock')->middleware('auth');
Route::post('/validateMathCaptcha', [ProductoHostalController::class, 'validateMathCaptcha'])->name('validateMathCaptcha')->middleware('auth');
Route::put('vender/{id}', [ProductoHostalController::class, 'vender'])->name('vender');
Route::get('productos.kardexpdf', [ProductoHostalController::class, 'kardexpdf'])->name('hostal.productos.kardexpdf')->middleware('auth');
//clientes
Route::get('ClienteHostal.index', [ClienteHostalController::class, 'index'])->name('hostal.ClienteHostal.index')->middleware('auth');     
Route::post('/store', [ClienteHostalController::class, 'store'])->name('store')->middleware('auth');
Route::get('ClienteHostal/InformacionCliente/{clienteHostal}', [ClienteHostalController::class, 'InformacionCliente'])->name('hostal.ClienteHostal.InformacionCliente')->middleware('auth');
Route::post('ClienteHostal.storelist', [ClienteHostalController::class, 'storelist'])->name('hostal.ClienteHostal.storelist')->middleware('auth');
Route::get('habitacion/{reservacion}/CambiarReserva', [HabitacionController::class, 'CambiarReserva'])->name('hostal.habitacion.CambiarReserva')->middleware('auth');
Route::get('habitacion/{hospedaje}/CambiarHospedaje', [HabitacionController::class, 'CambiarHospedaje'])->name('hostal.habitacion.CambiarHospedaje')->middleware('auth');
Route::get('habitacion/{reservacion}/CambiarReservaDatos', [HabitacionController::class, 'CambiarReservaDatos'])->name('hostal.habitacion.CambiarReservaDatos')->middleware('auth');
//validar documento
Route::get('validar-documento', [ClienteHostalController::class, 'validarDocumento'])->middleware('auth');
//backup date
Route::get('/backup', [BackupController::class, 'backup'])->middleware('auth');
//problemas
Route::get('problemas.listproblem', [ProblemaController::class, 'listproblem'])->name('hostal.problemas.listproblem')->middleware('auth');
Route::post('problemas.store', [ProblemaController::class, 'store'])->name('hostal.problemas.store')->middleware('auth');
Route::put('/problemas/{id}', [ProblemaController::class, 'update'])->name('hostal.problemas.update')->middleware('auth');
Route::get('problemas/data', [ProblemaController::class, 'data'])->name('problemas.data')->middleware('auth');
//whatsap
Route::get('/send-whatsapp-message', [WhatsAppController::class, 'sendWhatsAppMessage'])->middleware('auth');
//backup planilla
Route::post('personal.store', [PersonaController::class, 'store'])->name('admin.personal.store')->middleware('auth');
Route::get('personal/edit/{id}', [PersonaController::class, 'edit'])->name('personal.edit')->middleware('auth');
Route::put('updatepersonal/{id}', [PersonaController::class, 'updatepersonal'])->name('updatepersonal')->middleware('auth');
Route::delete('/personal/{id}', [PersonaController::class, 'eliminar'])->name('eliminarpersonal')->middleware('auth');
Route::get('admin.personal.index', [PersonaController::class, 'index'])->name('admin.personal.index')->middleware('auth');
Route::get('personal/data', [PersonaController::class, 'data'])->name('personal.data')->middleware('auth');
Route::get('personal.AsistenciaHoja', [PersonaController::class, 'AsistenciaHoja'])->name('admin.personal.AsistenciaHoja')->middleware('auth');
//Route::get('comanda.ReportePedidosMes', [ComandaController::class, 'ReportePedidosMes'])->name('admin.comanda.ReportePedidosMes');
Route::post('novedades.StoreNovedadProblema', [LibroNovedadeController::class, 'StoreNovedadProblema'])->name('admin.novedades.StoreNovedadProblema')->middleware('auth');
Route::get('novedades.index', [LibroNovedadeController::class, 'index'])->name('admin.novedades.index')->middleware('auth');
Route::get('controlcamareria.index', [ControlCamareriaController::class, 'index'])->name('hostal.controlcamareria.index')->middleware('auth');        
Route::post('controlcamareria.storecontrol', [ControlCamareriaController::class, 'storecontrol'])->name('hostal.controlcamareria.storecontrol')->middleware('auth');
Route::post('controlcamareria.reporte', [ControlCamareriaController::class, 'reporte'])->name('hostal.controlcamareria.reporte')->middleware('auth');
///impresoras
Route::get('festival.listarImpresoras', [FestivaleController::class, 'listarImpresoras'])->name('admin.festival.listarImpresoras')->middleware('auth');
Route::post('/imprimir-ticket', [FestivaleController::class, 'imprimirTicket'])->name('imprimir-ticket')->middleware('auth');
///festivales
Route::get('admin.festival.index', [FestivaleController::class, 'index'])->name('admin.festival.index')->middleware('auth');
Route::get('festival/{festival}/registrar', [FestivaleController::class, 'registrar'])->name('admin.festival.registrar')->middleware('auth');
Route::post('festival.storefestival', [FestivaleController::class, 'storefestival'])->name('admin.festival.storefestival')->middleware('auth');
Route::get('festival/pdf/{festival}', [FestivaleController::class, 'pdf'])->name('admin.festival.pdf')->middleware('auth');
Route::get('festival.reportefestival', [FestivaleController::class, 'reportefestival'])->name('admin.festival.reportefestival')->middleware('auth');
Route::get('festival.Reservas', [FestivaleController::class, 'Reservas'])->name('admin.festival.Reservas')->middleware('auth');
Route::get('festival/{festival}/RealizarReserva', [FestivaleController::class, 'RealizarReserva'])->name('admin.festival.RealizarReserva')->middleware('auth');
Route::post('festival.reservastore', [FestivaleController::class, 'reservastore'])->name('admin.festival.reservastore')->middleware('auth');
Route::get('festival/edit/{id}', [FestivaleController::class, 'edit'])->name('festival.edit')->middleware('auth');
Route::get('festival.reservaspdf', [FestivaleController::class, 'reservaspdf'])->name('admin.festival.reservaspdf')->middleware('auth');
Route::get('festival.tarjeta', [FestivaleController::class, 'tarjeta'])->name('admin.festival.tarjeta')->middleware('auth');
Route::put('updatereservafestival/{id}', [FestivaleController::class, 'updatereservafestival'])->name('updatereservafestival')->middleware('auth');
Route::get('festival/{festival}/concluirreserva', [FestivaleController::class, 'concluirreserva'])->name('admin.festival.concluirreserva')->middleware('auth');
Route::get('/obtener-datos-reserva', [FestivaleController::class, 'obtenerDatosReserva'])->name('admin.festival.obtenerDatosReserva')->middleware('auth');
Route::post('festival.storereservafestival', [FestivaleController::class, 'storereservafestival'])->name('admin.festival.storereservafestival')->middleware('auth');
Route::get('festival/pdfreserva/{festival}', [FestivaleController::class, 'pdfreserva'])->name('admin.festival.pdfreserva')->middleware('auth');
Route::get('festival/reservadata/{festival}', [FestivaleController::class, 'reservadata'])->name('festival.reservadata')->middleware('auth');
Route::post('festival.festivalstore', [FestivaleController::class, 'festivalstore'])->name('admin.festival.festivalstore')->middleware('auth');
Route::get('festival.croquismap', [FestivaleController::class, 'croquismap'])->name('admin.festival.croquismap')->middleware('auth');
Route::post('festival.guardarPosiciones', [FestivaleController::class, 'guardarPosiciones'])->name('admin.festival.guardarPosiciones')->middleware('auth');
Route::get('festival/obtener-posiciones', [FestivaleController::class, 'obtenerPosiciones'])->name('admin.festival.obtenerPosiciones');
Route::post('festival.addreservafestival', [FestivaleController::class, 'addreservafestival'])->name('admin.festival.addreservafestival')->middleware('auth');
Route::post('festival.addfestival', [FestivaleController::class, 'addfestival'])->name('admin.festival.addfestival')->middleware('auth');
Route::get('menu.plantilla',[MenuController::class,'plantilla'])->name('admin.menu.plantilla')->middleware('auth');
Route::get('menu.plantillatriple',[MenuController::class,'plantillatriple'])->name('admin.menu.plantillatriple')->middleware('auth');
Route::get('menu.menudomingo',[MenuController::class,'menudomingo'])->name('admin.menu.menudomingo')->middleware('auth');
Route::get('menu.plantillasemana',[MenuController::class,'plantillasemana'])->name('admin.menu.plantillasemana')->middleware('auth');

/* BAR */
Route::get('bar.index',[BarController::class,'index'])->name('admin.bar.index')->middleware('auth');
Route::post('bar.guardarPosiciones', [BarController::class, 'guardarPosiciones'])->name('admin.bar.guardarPosiciones')->middleware('auth');
Route::get('bar/consumir/{id}', [BarController::class, 'consumir'])->name('bar.consumir')->middleware('auth');
Route::post('/registrar-ventasbar', [BarController::class, 'ventasbar']);
Route::get('bar/waitfood/{id}', [BarController::class, 'waitfood'])->name('bar.waitfood')->middleware('auth');
Route::get('bar/concluirventa', [BarController::class, 'concluirventa'])->name('bar.concluirventa')->middleware('auth');
Route::get('bar/pdf/{listacomanda}', [BarController::class, 'pdf'])->name('admin.bar.pdf')->middleware('auth');

/*AUDITORIA*/
Route::get('/audits', [AuditoriaController::class,'index'])->name('audits.index')->middleware('auth');
Route::get('/audits/data', [AuditoriaController::class,'auditsData'])->name('audits.data')->middleware('auth');

/*QR CODIGO MENU*/
Route::get('/menubar', [QRMenuControlador::class, 'menubar']);
Route::get('/menurestaurante', [QRMenuControlador::class, 'menurestaurante']);
Route::get('/GenerarCodigoQR', [QRMenuControlador::class, 'GenerarCodigoQR']);
Route::get('/nuestrositio', [QRMenuControlador::class, 'nuestrositio']);

Route::get('/mostrar-impresoras', [ComandaController::class, 'Impresoras']);

Route::get('detallecaja/datacomanda', [ComandaController::class, 'datacomanda'])->name('detallecaja.datacomanda ')->middleware('auth');
Route::post('comanda.deliveri', [ComandaController::class, 'deliveri'])->name('admin.comanda.deliveri')->middleware('auth');
Route::get('estado_deliveri/deliveris/{deliveri}', [ComandaController::class, 'estado_deliveri'])->name('cambio.estado.deliveri')->middleware('auth');
Route::get('comanda.deliverisdeuda', [ComandaController::class, 'deliverisdeuda'])->name('comanda.deliverisdeuda')->middleware('auth');


Route::post('/actualizar_estado_plato', [PlatoController::class, 'actualizarEstadoPlato']);
Route::post('/actualizar_estado_categoria', [PlatoController::class, 'actualizarEstadoCategoria']);
Route::get('/deliveris', [ComandaController::class, 'getAllDeliveris'])->name('deliveris.index');
Route::get('/deliveris/filtrar', [ComandaController::class, 'filtrarDeliveris'])->name('deliveris.filtrar');

Route::get('/get-group-id', [TelegramBotController::class, 'getGroupId']);
Route::get('/get-all-group-ids', [TelegramBotController::class, 'getAllGroupIds']);
Route::get('/send-message-to-group', [TelegramBotController::class, 'sendMessageToGroup']);
