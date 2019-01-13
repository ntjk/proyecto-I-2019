<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* what the fuck am i doing? */
Route::get('/home', 'HomeController@index')->name('home');
Route::get('welcome', function () {
    return view('welcome');
});

/* oh right console commands lol */
Auth::routes();

/* basic shit */
Route::get('/', function () {
    return view('welcome');
});
Route::get('quienes_somos', function(){
  return view('quienes_somos');
});
Route::get('buscadorChequeo', function(){
  return view('buscadorChequeo');
});
Route::get('inicioSesion', function(){
  return view('inicio');
});

/* REAL HACKER HOURS */
/* sucursal */
Route::resource('sucursal','SucursalController');
Route::post('sucursal/getOne','SucursalController@getOne');
Route::post('sucursal/updateSelect','SucursalController@updateSelect');
Route::get('sucursal', 'SucursalController@index');
Route::get('sucursal-getData','SucursalController@getData')->name('sucursal_getData');
Route::get('sucursal{id}-{year}-{month}-{day}','SucursalController@showNomina');
// @eso quiere decir el metodo eso
/* rol */
Route::resource('rol','RolController');
Route::post('rol/getOne','RolController@getOne');
Route::post('rol/updateSelect','RolController@updateSelect');
Route::get('rol','RolController@index');
Route::get('rol-getData','RolController@getData')->name('rol_getData');

/* usuario */
Route::resource('usuario','UsuarioController');
Route::post('usuario/getOne','UsuarioController@getOne');
Route::post('usuario/updateSelect','UsuarioController@updateSelect');
Route::get('usuario','UsuarioController@index');
Route::get('usuario-getData','UsuarioController@getData')->name('usuario_getData');

/* empleado */
Route::resource('empleado','EmpleadoController');
Route::post('empleado/getOne','EmpleadoController@getOne');
Route::post('empleado/updateSelect','EmpleadoController@updateSelect');
Route::post('empleado/updateSelect2','EmpleadoController@updateSelect2');
Route::get('empleado','EmpleadoController@index');
Route::get('empleado-getData','EmpleadoController@getData')->name('empleado_getData');

/* ruta */
Route::resource('ruta','RutaController');
Route::post('ruta/getOne','RutaController@getOne');
Route::post('ruta/updateSelect','RutaController@updateSelect');
Route::get('ruta','RutaController@index');
Route::get('ruta-getData','RutaController@getData')->name('ruta_getData');

/* Flota Terrestre */
Route::resource('transporte','FlotaController');
Route::post('transporte/getOne','FlotaController@getOne');
Route::post('transporte/updateSelect','FlotaController@updateSelect');
Route::get('transporte', 'FlotaController@index');
Route::get('transporteT-getData','FlotaController@getDataT')->name('transporteT_getData');

/* Flota Maritima */
Route::resource('transporteM','FlotaController');
Route::post('transporteM/getOne','FlotaController@getOne');
Route::post('transporteM/updateSelect','FlotaController@updateSelect');
Route::get('transporteM', 'FlotaController@indexM');
Route::get('transporteM-getData','FlotaController@getDataM')->name('transporteM_getData');

/* Flota Aerea */
Route::resource('transporteA','FlotaController');
Route::post('transporteA/getOne','FlotaController@getOne');
Route::post('transporteA/updateSelect','FlotaController@updateSelect');
Route::get('transporteA', 'FlotaController@indexA');
Route::get('transporteA-getData','FlotaController@getDataA')->name('transporteA_getData');

/*Cliente */
Route::resource('cliente','ClienteController');
Route::post('cliente/getOne','ClienteController@getOne');
Route::post('cliente/updateSelect','ClienteController@updateSelect');
Route::post('cliente/updateSelect2','ClienteController@updateSelect2');
Route::get('cliente', 'ClienteController@index');
Route::get('cliente-getData','ClienteController@getData')->name('cliente_getData');
Route::get('cliente{id}','ClienteController@showCarnet');

/* Envio */
Route::resource('envio','EnvioController');
Route::post('envio/getOne','EnvioController@getOne');
Route::post('envio/updateSelect','EnvioController@updateSelect');
Route::post('envio/updatePrecio','EnvioController@updatePrecio');
Route::get('envio', 'EnvioController@index');
Route::get('envio-getData','EnvioController@getData')->name('envio_getData');

/* ruta */
//Route::resource('floru','FloruController');
Route::get('floru', function(){
  return view('floru');
});
Route::post('floru/agregarRuta','FloruController@guardarRuta');
Route::post('floru/getOne','FloruController@getOne');
Route::post('floru/updateSelect','FloruController@updateSelect');
Route::get('floru','FloruController@index');
//Route::get('floru-getData','FloruController@getData')->name('floru_getData');

/*tipo paquete*/
Route::resource('tipo','TipoController');
Route::post('tipo/getOne','TipoController@getOne');
Route::post('tipo/updateSelect','TipoController@updateSelect');
Route::get('tipo','TipoController@index');
Route::get('tipo-getData','TipoController@getData')->name('tipo_getData');

/*chequeo - rastreo*/
Route::resource('chequeo','ChequeoController');
Route::post('chequeo/getOne','ChequeoController@getOne');
Route::post('chequeo/updateSelect','ChequeoController@updateSelect');
Route::get('chequeo-getData','ChequeoController@getData')->name('chequeo_getData');
Route::get('chequeo{id}', 'ChequeoController@show');

//Probando
Route::get("/aja",function(){
$resul=DB::select("select * from sucursal where su_clave = ?", [12]);
	foreach($resul as $resu){
		return $resu->su_nombre;
	}
});

/* Consultas */
Route::get('consultas','ConsultasController@index');

Route::get('consulta1','ConsultasEnvioController@calcularMesConMasEnvios');
Route::get('consulta2','ConsultasEnvioController@pesoPromedioPorOficina');
Route::get('consulta3','ConsultasEnvioController@enviosPorEstatus');
Route::get('consulta4','ConsultasEnvioController@origenDestinoMaxPaquetes');
Route::get('consulta5','ConsultasEnvioController@calcularMesConMasEnvios2');
Route::get('consulta101','ConsultasEnvioController@calcularMesConMasEnvios3');

Route::get('consulta6', function(){
  $paraDiferenciar = 6;
  return view('buscadorFecha')->with(compact('paraDiferenciar')); });
Route::get('filtrarFecha_1{f}','ConsultasEnvioController@consulta6');

Route::get('consulta7', 'ConsultasEnvioController@promedioPaquetesDiarios');
Route::get('filtrarFecha_2{rango}','ConsultasEnvioController@consulta6_2');

Route::get('consulta8','ConsultasEnvioController@paquetesConMedios');
Route::get('consulta9','ConsultasEnvioController@promedioEstanciaZonas');
Route::get('consulta10','ConsultasClienteController@masEnviosPorOfic');
Route::get('consulta11','ConsultasClienteController@vipPorOfic');

Route::get('consulta12', function(){
  $paraDiferenciar = 12;
  return view('buscadorFecha')->with(compact('paraDiferenciar')); });
Route::get('filtrarFecha_3{rango}','ConsultasEnvioController@clasificacionPaquetesPorOficina');

Route::get('consulta14', 'ConsultasEmpleadoController@inasistenciasEmpleados');
Route::get('consulta15', 'ConsultasEmpleadoController@inasistenciasEmpleadosSinHorario');
Route::get('consulta16', 'ConsultasFlotaController@flotaPorOfic');
Route::get('consulta17', 'ConsultasFlotaController@flotaPorSubtipo');
Route::get('consulta18', 'ConsultasFlotaController@flotaPorTipo');
Route::get('consulta19', 'ConsultasFlotaController@flotaTerrestre');
//Route::get('consulta20', 'ConsultasFlotaController@avgEnviosSucursales');
Route::get('consulta20-{id}-{tiempo}', 'ConsultasSucursalController@avgEnviosSucursales');
Route::get('consulta21', 'ConsultasSucursalController@oficPorEstado');
Route::get('consulta22', 'ConsultasSucursalController@oficYZonaPorEstado');
Route::get('consulta23', 'ConsultasSucursalController@oficInternacionales');
Route::get('consulta24', 'ConsultasSucursalController@flotaTerrestre');

/*Asistencias*/
Route::resource('asistencia','AsistenciaController');
Route::post('asistencia/getOne','AsistenciaController@getOne');
Route::post('asistencia/updateSelect','AsistenciaController@updateSelect');
Route::get('asistencia','AsistenciaController@index');
Route::get('asistencia-getData','AsistenciaController@getData')->name('asistencia_getData');

/*Permisos de un rol*/
Route::resource('rolper','RolperController');
Route::post('rolper/getOne','RolperController@getOne');
Route::post('rolper/updateSelect','RolperController@updateSelect');
Route::get('rolper{id}', 'RolperController@show');


Route::get('sesion', 'ConsultasEnvioController@verificarPermisos');
Route::get('sesion2', 'ConsultasEnvioController@validarUsuario2');
//Route::post('envio/updatePrecio','EnvioController@updatePrecio');
